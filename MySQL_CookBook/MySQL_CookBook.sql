/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  luis_
 * Created: 08/10/2018
 */

 mysql> SELECT d, CONCAT(YEAR(d),'-',MONTH(d),'-01') FROM date_val;
  mysql> SELECT d, CONCAT(YEAR(d),'-',LPAD(MONTH(d),2,'0'),'-01')
    -> FROM date_val;
  mysql> SELECT t1,
-> CONCAT(LPAD(HOUR(t1),2,'0'),':',LPAD(MINUTE(t1),2,'0'),':00')
-> AS recombined
-> FROM time_val;
  mysql> SET @d = '2014-02-28', @t = '13:10:05';
  mysql> SELECT @d, @t, CONCAT(@d,' ',@t);
  mysql> SELECT t1,
-> TIME_TO_SEC(t1) AS 'TIME to seconds',
-> SEC_TO_TIME(TIME_TO_SEC(t1)) AS 'TIME to seconds to TIME'
-> FROM time_val;
  mysql> SELECT t1,
-> TIME_TO_SEC(t1) AS 'seconds',
-> TIME_TO_SEC(t1)/60 AS 'minutes',
-> TIME_TO_SEC(t1)/(60*60) AS 'hours',
-> TIME_TO_SEC(t1)/(24*60*60) AS 'days'
-> FROM time_val;
  mysql> SELECT d,
-> TO_DAYS(d) AS 'DATE to days',
-> FROM_DAYS(TO_DAYS(d)) AS 'DATE to days to DATE'
-> FROM date_val;
  mysql> SELECT dt,
-> TO_DAYS(dt) AS 'date part in days',
-> FROM_DAYS(TO_DAYS(dt)) AS 'date part as DATE'
-> FROM datetime_val;
  mysql> SELECT dt,
-> UNIX_TIMESTAMP(dt) AS seconds,
-> FROM_UNIXTIME(UNIX_TIMESTAMP(dt)) AS timestamp
-> FROM datetime_val;
  mysql> set time_zone = '+00:00';
  mysql> SELECT dt,
-> UNIX_TIMESTAMP(dt) AS seconds,
-> FROM_UNIXTIME(UNIX_TIMESTAMP(dt)) AS timestamp
-> FROM datetime_val;
  mysql> SELECT
-> CURDATE(),
-> UNIX_TIMESTAMP(CURDATE()),
-> FROM_UNIXTIME(UNIX_TIMESTAMP(CURDATE()))\G
*************************** 1. row ***************************
CURDATE(): 2014-02-20
UNIX_TIMESTAMP(CURDATE()): 1392876000
FROM_UNIXTIME(UNIX_TIMESTAMP(CURDATE())): 2014-02-20 00:00:00
  mysql> SET @d1 = '2010-01-01', @d2 = '2009-12-01';
  mysql> SELECT DATEDIFF(@d1,@d2) AS 'd1 - d2', DATEDIFF(@d2,@d1) AS 'd2 - d1';
  mysql> SET @t1 = '12:00:00', @t2 = '16:30:00';
  mysql> SELECT TIMEDIFF(@t1,@t2) AS 't1 - t2', TIMEDIFF(@t2,@t1) AS 't2 - t1';
 * mysql> SELECT t1, t2,
-> TIMEDIFF(t2,t1) AS 't2 - t1 as TIME',
-> IF(TIMEDIFF(t2,t1) >= 0,'+','-') AS sign,
-> HOUR(TIMEDIFF(t2,t1)) AS hour,
-> MINUTE(TIMEDIFF(t2,t1)) AS minute,
-> SECOND(TIMEDIFF(t2,t1)) AS second
-> FROM time_val;
 * mysql> SET @dt1 = '1900-01-01 00:00:00', @dt2 = '1910-01-01 00:00:00';
mysql> SELECT
-> TIMESTAMPDIFF(MINUTE,@dt1,@dt2) AS minutes,
-> TIMESTAMPDIFF(HOUR,@dt1,@dt2) AS hours,
-> TIMESTAMPDIFF(DAY,@dt1,@dt2) AS days,
-> TIMESTAMPDIFF(WEEK,@dt1,@dt2) AS weeks,
-> TIMESTAMPDIFF(YEAR,@dt1,@dt2) AS years;

LOAD DATA LOCAL INFILE 'has_nulls.txt'
INTO TABLE t (@c1, @c2, @c3)
SET 
c1 = IF(@c1='Unknown', NULL, @c1),
c2 = IF(@c2=-1,NULL,@c2),
c3 = IF(@c3='',NULL,@c3);

#!/usr/bin/perl
# mysql_to_text.pl: Export MySQL query output in user-specified text format.
# Usage: mysql_to_text.pl [ options ] [db_name] > text_file
use strict;
use warnings;
use DBI;
use Text::CSV_XS;
use Getopt::Long;
$Getopt::Long::ignorecase = 0; # options are case sensitive
$Getopt::Long::bundling = 1; # permit short options to be bundled
# ... construct usage message variable $usage (not shown) ...
# Variables for command line options - all undefined initially
# except for options that control output structure, which is set
# to be tab-delimited, linefeed-terminated.
my $help;
my ($host_name, $password, $port_num, $socket_name, $user_name, $db_name);
my ($stmt, $tbl_name);
my $labels;
my $delim = "\t";
my $quote;
my $eol = "\n";
GetOptions (
# =i means an integer value is required after the option
# =s means a string value is required after the option
"help" => \$help, # print help message
"host|h=s" => \$host_name, # server host
"password|p=s" => \$password, # password
"port|P=i" => \$port_num, # port number
"socket|S=s" => \$socket_name, # socket name
"user|u=s" => \$user_name, # username
"execute|e=s" => \$stmt, # statement to execute
"table|t=s" => \$tbl_name, # table to export
"labels|l" => \$labels, # generate row of column labels
"delim=s" => \$delim, # column delimiter
"quote=s" => \$quote, # column quoting character
"eol=s" => \$eol # end-of-line (record) delimiter
) or die "$usage\n";
die "$usage\n" if defined ($help);
$db_name = shift (@ARGV) if @ARGV;
# One of --execute or --table must be specified, but not both
die "You must specify a query or a table name\n\n$usage\n"
unless defined ($stmt) || defined ($tbl_name);
die "You cannot specify both a query and a table name\n\n$usage\n"
if defined ($stmt) && defined ($tbl_name);
# interpret special chars in the file structure options
$quote = interpret_option ($quote);
$delim = interpret_option ($delim);
$eol = interpret_option ($eol);

my $dsn = "DBI:mysql:";
$dsn .= ";database=$db_name" if $db_name;
$dsn .= ";host=$host_name" if $host_name;
$dsn .= ";port=$port_num" if $port_num;
$dsn .= ";mysql_socket=$socket_name" if $socket_name;
# read [client] group parameters from standard option files
$dsn .= ";mysql_read_default_group=client";
my $conn_attrs = {PrintError => 0, RaiseError => 1, AutoCommit => 1};
my $dbh = DBI->connect ($dsn, $user_name, $password, $conn_attrs);

my $csv = Text::CSV_XS->new ({
sep_char => $delim,
quote_char => $quote,
escape_char => $quote,
eol => $eol,
binary => 1
});
# If table name was given, use it to create query that selects entire table.
# Split on dots in case it's a qualified name, to quote parts separately.
$stmt = "SELECT * FROM " . $dbh->quote_identifier (split (/\./, $tbl_name))
if defined ($tbl_name);
warn "$stmt\n";
my $sth = $dbh->prepare ($stmt);
$sth->execute ();
if ($labels) # write row of column labels
{
$csv->combine (@{$sth->{NAME}}) or die "cannot process column labels\n";
print $csv->string ();
}
my $count = 0;
while (my @val = $sth->fetchrow_array ())
{
++$count;
$csv->combine (@val) or die "cannot process column values, row $count\n";
print $csv->string ();
}

#!/usr/bin/perl
# yank_col.pl: Extract columns from input.
# Example: yank_col.pl --columns=2,11,5,9 filename
# Assumes tab-delimited, linefeed-terminated input lines.
# ... process command-line options (not shown) ...
# ... to get column list into @col_list array ...
while (<>) # read input
{
chomp;
my @val = split (/\t/, $_, 10000); # split, preserving all fields
# extract desired columns, mapping undef to empty string (can
# occur if an index exceeds number of columns present in line)
@val = map { defined ($_) ? $_ : "" } @val[@col_list];
print join ("\t", @val) . "\n";
}

#!/usr/bin/perl
# from_excel.pl: Read Excel spreadsheet, write tab-delimited,
# linefeed-terminated output to the standard output.
use strict;
use warnings;
use Spreadsheet::ParseExcel::Simple;
@ARGV or die "Usage: $0 excel-file\n";
my $xls = Spreadsheet::ParseExcel::Simple->read ($ARGV[0]);
foreach my $sheet ($xls->sheets ())
{
while ($sheet->has_data ())
{
my @data = $sheet->next_row ();
print join ("\t", @data) . "\n";
}
}

#!/usr/bin/perl
# to_excel.pl: Read tab-delimited, linefeed-terminated input, write
# Excel-format output to the standard output.
use strict;
use warnings;
use Excel::Writer::XLSX;
binmode (STDOUT);
my $ss = Excel::Writer::XLSX->new (\*STDOUT);
my $ws = $ss->add_worksheet ();
my $row = 0;
while (<>) # read each row of input
{
chomp;
my @data = split (/\t/, $_, 10000); # split, preserving all fields
my $col = 0;
foreach my $val (@data) # write row to the worksheet
{
$ws->write ($row, $col, $val);
$col++;
}
$row++;
}


#!/usr/bin/perl
# mysql_to_excel.pl: Given a database and table name,
# dump the table to the standard output in Excel format.
use strict;
use warnings;
use DBI;
use Spreadsheet::ParseExcel::Simple;
use Spreadsheet::WriteExcel::FromDB;
# ... process command-line options (not shown) ...
# ... to get $db_name, $tbl_name ...
# ... connect to database (not shown) ...
my $ss = Spreadsheet::WriteExcel::FromDB->read ($dbh, $tbl_name);
binmode (STDOUT);
print $ss->as_xls ();

% mysql_to_xml.pl --execute="SELECT * FROM expt" cookbook > expt.xml
% mysql_to_xml.pl --table=cookbook.expt > expt.xml

#!/usr/bin/perl
# mysql_to_xml.pl: Given a database and table name,
# dump the table to the standard output in XML format.
use strict;
use warnings;
use DBI;
use XML::Generator::DBI;
use XML::Handler::YAWriter;
# ... process command-line options (not shown) ...
# ... connect to database (not shown) ...
# Create output writer; "-" means "standard output"
my $out = XML::Handler::YAWriter->new (AsFile => "-");
# Set up connection between DBI and output writer
my $gen = XML::Generator::DBI->new (
dbh => $dbh, # database handle
Handler => $out, # output writer
RootElement => "rowset" # document root element
);
# If table name was given, use it to create query that selects entire table.
# Split on dots in case it's a qualified name, to quote parts separately.
$stmt = "SELECT * FROM " . $dbh->quote_identifier (split (/\./, $tbl_name))
if defined ($tbl_name);
# Issue query and write XML
$gen->execute ($stmt);
$dbh->disconnect ();


#!/usr/bin/perl
# xml_to_mysql.pl: Read XML file into MySQL.
use strict;
use warnings;
use DBI;
use XML::XPath;
# ... process command-line options (not shown) ...
# ... connect to database (not shown) ...
# Open file for reading
my $xp = XML::XPath->new (filename => $file_name);
my $row_list = $xp->find ("//row"); # find set of <row> elements
print "Number of records: " . $row_list->size () . "\n";
foreach my $row ($row_list->get_nodelist ()) # loop through rows
{
my @name; # array for column names
my @val; # array for column values
my $col_list = $row->find ("*"); # child columns of row
foreach my $col ($col_list->get_nodelist ()) # loop through columns
{
push (@name, $col->getName ()); # save column name
push (@val, $col->string_value ()); # save column value
}
# construct INSERT statement, then execute it
my $stmt = "INSERT INTO $tbl_name ("
. join (",", @name)
. ") VALUES ("
. join (",", ("?") x scalar (@val))
. ")";
$dbh->do ($stmt, undef, @val);
}
$dbh->disconnect ();

% cvt_file.pl --iformat=csv commodities.csv > tmp1.txt
% cvt_date.pl --iformat=us tmp1.txt > tmp2.txt
LOAD DATA LOCAL INFILE 'tmp2.txt' INTO TABLE commodities IGNORE 1 LINES;

SHOW WARNINGS;

SET sql_mode = 'STRICT_ALL_TABLES';
SET sql_mode = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE';
SET sql_mode = 'TRADITIONAL';
SET GLOBAL sql_mode = 'mode_value';

use strict;
use warnings;

$it_matched = ($val =~ /pat/); # pattern match
$it_matched = ($val =~ /pat/i); # case-insensitive match
$it_matched = ($val =~ m|pat|); # alternate constructor character
$no_match = ($val !~ /pat/); # negated pattern match
$val =~ s/^\s+//; # trim leading whitespace
$val =~ s/\s+$//; # trim trailing whitespace

Pattern Type of value the pattern matches
/^$/ Empty value
/./ Nonempty value
/^\s*$/ Whitespace, possibly empty
/^\s+$/ Nonempty whitespace
/\S/ Nonempty, and not only whitespace
/^\d+$/ Digits only, nonempty
/^[a-z]+$/i Alphabetic characters only (case insensitive), nonempty
/^\w+$/ Alphanumeric or underscore characters only, nonempty

Pattern Type of value the pattern matches
/^\d+$/ Unsigned integer
/^-?\d+$/ Negative or unsigned integer
/^[-+]?\d+$/ Signed or unsigned integer
/^[-+]?(\d+(\.\d*)?|\.\d+)$/ Floating-point number

select column_type from information_schema.columns
where
table_schema = 'cookbook' and table_name = 'profile' 
and
column_name = 'color';

sub check_enum_value
{
my ($dbh, $db_name, $tbl_name, $col_name, $val) = @_;
    my $valid = 0;
    my $info = get_enumorset_info ($dbh, $db_name, $tbl_name, $col_name);
    if ($info && uc ($info->{type}) eq "ENUM")
    {
        # use case-insensitive comparison because default collation
        # (latin1_swedish_ci) is case-insensitive (adjust if you use
        # a different collation)
        $valid = grep (/^$val$/i, @{$info->{values}});
    }
    return $valid;
}

my $ref = get_enumorset_info ($dbh, $db_name, $tbl_name, $col_name);
my %members;
# convert hash key to consistent lettercase
map { $members{lc ($_)} = 1; } @{ref->{values}};
$valid = exists ($members{lc ($val)});

sub check_set_value
{
my ($dbh, $db_name, $tbl_name, $col_name, $val) = @_;
my $valid = 0;
my $info = get_enumorset_info ($dbh, $db_name, $tbl_name, $col_name);
if ($info && uc ($info->{type}) eq "SET")
{
return 1 if $val eq ""; # empty string is legal element
# use case-insensitive comparison because default collation
# (latin1_swedish_ci) is case-insensitive (adjust if you use
# a different collation)
$valid = 1; # assume valid until we find out otherwise
foreach my $v (split (/,/, $val))
{
if (!grep (/^$v$/i, @{$info->{values}}))
{
$valid = 0; # value contains an invalid element
last;
}
}
}
return $valid;
}

$valid = 1; # assume valid until we find out otherwise
foreach my $elt (split (/,/, lc ($val)))
{
if (!exists ($members{$elt}))
{
$valid = 0; # value contains an invalid element
last;
}
}

$valid = $dbh->selectrow_array (
"SELECT COUNT(*) FROM $tbl_name WHERE val = ?",
undef, $val);
my %members; # hash for lookup values
my $sth = $dbh->prepare ("SELECT val FROM $tbl_name");
$sth->execute ();
while (my ($val) = $sth->fetchrow_array ())
{
$members{$val} = 1;
}
Perform a hash key existence test to check a given value:
$valid = exists ($members{$val});

my %members; # hash for lookup values
my $sth = $dbh->prepare ("SELECT val FROM $tbl_name");
$sth->execute ();
while (my ($val) = $sth->fetchrow_array ())
{
$members{$val} = 1;
}
$valid = exists ($members{$val});

if (!exists ($members{$val})) # haven't seen this value yet
{
my $count = $dbh->selectrow_array (
"SELECT COUNT(*) FROM $tbl_name WHERE val = ?",
undef, $val);
# store true/false to indicate whether value was found
$members{$val} = ($count > 0);
}
$valid = $members{$val};

sub yy_to_ccyy
{
my ($year, $transition_point) = @_;
$transition_point = 70 unless defined ($transition_point);
$year += ($year >= $transition_point ? 1900 : 2000) if $year < 100;
return $year;
}

sub is_valid_date
{
my ($year, $month, $day) = @_;
# year must be nonnegative, month and day must be positive
return 0 if $year < 0 || $month < 1 || $day < 1;
# check maximum limits on individual parts
return 0 if $year > 9999
|| $month > 12
|| $day > days_in_month ($year, $month);
return 1;
}
sub is_leap_year
{
my $year = $_[0];
return ($year % 4 == 0) && ((($year % 100) != 0) || ($year % 400) == 0);
}
sub days_in_month
{
my ($year, $month) = @_;
my @day_tbl = (31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
my $days = $day_tbl[$month-1];
# add a day for Feb of leap years
$days++ if $month == 2 && is_leap_year ($year);
return $days;
}

sub is_ampm_time
{
my $s = $_[0];
return undef unless $s =~ /^(\d{1,2})\D(\d{2})\D(\d{2})(?:\s*(AM|PM))?$/i;
my ($hour, $min, $sec) = ($1, $2, $3);
if ($hour == 12 && (!defined ($4) || uc ($4) eq "AM"))
{
$hour = "00"; # 12:xx:xx AM times are 00:xx:xx
}
elsif ($hour < 12 && defined ($4) && uc ($4) eq "PM")
{
$hour += 12; # PM times other than 12:xx:xx
}
return [ $hour, $min, $sec ]; # return hour, minute, second
}
/*---------------------------------------------------------------------*/

#!/usr/bin/perl
# isoize_date.pl: Read input data, look for values that match
# a date pattern, convert them to ISO format. Also converts
# 2-digit years to 4-digit years, using a transition point of 70.
# By default, this looks for dates in MM-DD-[CC]YY format.
# Does not check whether dates actually are valid (for example,
# won't complain about 13-49-1928).
# Assumes tab-delimited, linefeed-terminated input lines.

use strict;
use warnings;
# transition point at which 2-digit XX year values are assumed to be
# 19XX (below that, they are treated as 20XX)
my $transition = 70;
while (<>)
{
chomp;
my @val = split (/\t/, $_, 10000); # split, preserving all fields
for my $i (0 .. @val - 1)
{
# look for strings in MM-DD-[CC]YY format
next unless $val[$i] =~ /^(\d{1,2})\D(\d{1,2})\D(\d{2,4})$/;
my ($month, $day, $year) = ($1, $2, $3);
# to interpret dates as DD-MM-[CC]YY instead, replace preceding
# line with the following one:
#my ($day, $month, $year) = ($1, $2, $3);
# convert 2-digit years to 4 digits, then update value in array
$year += ($year >= $transition ? 1900 : 2000) if $year < 100;
$val[$i] = sprintf ("%04d-%02d-%02d", $year, $month, $day);
}
print join ("\t", @val) . "\n";
}

#!/usr/bin/perl
# monddccyy_to_iso.pl: Convert dates from mon[.] dd, ccyy to ISO format.
# Assumes tab-delimited, linefeed-terminated input
use strict;
use warnings;
my %map = # map 3-char month abbreviations to numeric month
(
"jan" => 1, "feb" => 2, "mar" => 3, "apr" => 4, "may" => 5, "jun" => 6,
"jul" => 7, "aug" => 8, "sep" => 9, "oct" => 10, "nov" => 11, "dec" => 12
);
while (<>)
{
chomp;
my @val = split (/\t/, $_, 10000); # split, preserving all fields
for my $i (0 .. @val - 1)
{
# reformat the value if it matches the pattern, otherwise assume
# that it's not a date in the required format and leave it alone
if ($val[$i] =~ /^([^.]+)\.? (\d+), (\d+)$/)
{
# use lowercase month name
my ($month, $day, $year) = (lc ($1), $2, $3);
if (exists ($map{$month}))
{
$val[$i] = sprintf ("%04d-%02d-%02d", $year, $map{$month}, $day);
}
else
{
# warn, but don't reformat
warn "$val[$i]: bad date?\n";
}
}
}
print join ("\t", @val) . "\n";
}

LOAD DATA LOCAL INFILE 'newdata.txt' INTO TALBE t (name,@data,value) SET 
date = STR_TO_DATE(@date,'%m/%d/%y');

LOAD DATA LOCAL INFELE 'newdata.txt' INTO TALBE t (name,@date,value) SET 
date = my_date_interp(@date);

SELECT i, c, 
DATA_FORMAT(, '%m-%d-%y') as d,
DATA_FORMAT(, '%m-%d-%Y %T') as dt,
DATA_FORMAT(, '%m-%d-%Y %T') as ts FROM datetbl;

% cvt_file.pl --iformat=csv somedata.csv \
| yank_col.pl --columns=2,11,5,9 \
| cvt_date.pl --columns=2 --iformat=us --add-century > tmp

#!/usr/bin/perl
# validate_htwt.pl: Height/weight validation example.
# Assumes tab-delimited, linefeed-terminated input lines.
# Input columns and the actions to perform on them are as follows:
# 1: name; echo as given
# 2: birth; echo as given
# 3: height; validate as positive integer
# 4: weight; validate as positive integer
use strict;
use warnings;
use Cookbook_Utils;
while (<>)
{
chomp;
my ($name, $birth, $height, $weight) = split (/\t/, $_, 4);
warn "line $.:height $height is not a positive integer\n"
if !is_positive_integer ($height);
warn "line $.:weight $weight is not a positive integer\n"
if !is_positive_integer ($weight);
}

LOAD DATA LOCAL INFILE 'tmp' INTO TABLE tbl_name;

# The following table shows some of the special pattern elements available in Perl regular expressions:

/*
Pattern  What the pattern matches
^        Beginning of string
$        End of string
.        Any character
\s, \S   Whitespace or nonwhitespace character
\d, \D   Digit or nondigit character
\w, \W   Word (alphanumeric or underscore) or nonword character
[...]    Any character listed between the square brackets
[^...]   Any character not listed between the square brackets
p1|p2|p3 Alternation; matches any of the patterns p1, p2, or p3
*        Zero or more instances of preceding element
+        One or more instances of preceding element
{n}      n instances of preceding element
{m,n}    m through n instances of preceding element
*/


# 12.4. Using Patterns to Match Broad Content Types

/*
Pattern     Type of value the pattern matches
/^$/        Empty value
/./         Nonempty value
/^\s*$/     Whitespace, possibly empty
/^\s+$/     Nonempty whitespace
/\S/        Nonempty, and not only whitespace
/^\d+$/     Digits only, nonempty
/^[a-z]+$/i Alphabetic characters only (case insensitive), nonempty
/^\w+$/     Alphanumeric or underscore characters only, nonempty
*/


# Using Patterns to Match Numeric Values

/*
Pattern                      Type of value the pattern matches
/^\d+$/                      Unsigned integer
/^-?\d+$/                    Negative or unsigned integer
/^[-+]?\d+$/                 Signed or unsigned integer
/^[-+]?(\d+(\.\d*)?|\.\d+)$/ Floating-point number
*/


# ZIP codes

/*
Pattern             Type of value the pattern matches
/^\d{5}$/           ZIP code, five digits only
/^\d{5}-\d{4}$/     ZIP+4 code
/^\d{5}(-\d{4})?$/  ZIP or ZIP+4 code
*/

/* To add one day to a date */

SELECT DATE_HIRE, DATE_ADD(DATE_HIRE, INTERVAL 1 DAY), DATE_HIRE + 1
FROM EMPLOYEE_PAY_TBL
WHERE EMP_ID = ‘311549902’;