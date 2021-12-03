<?php

require("commonfunctions.php");
$functionname = getgreetingfunction();

echo $functionname();
echo $functionname(true);

echo '<h1>Built-in functions</h1>';

echo '<p>PHP has a large set of built-in functions. We can classify these functions into several categories. The most important of them, according to the scope of this book, are displayed in the following list.</p>';

echo '<ol style="list-style-type: disc">
            <li>Array functions – Allow us to interact with and manipulate arrays</li>
            <li>Date & Time functions – Help us to get the date and time from the server in which scripts are running</li>
            <li>String functions – Allow us to manipulate strings</li>
            <li>Character functions – Help us to check whether a string or character falls into a certain class</li>
            <li>File system functions – Used to access and manipulate the file system of the server in which scripts are running</li>
            <li>Directory functions – Used to manipulate directories located at the server in which scripts are running</li>
      </ol>';

echo '<p>The following sections summarize each category of functions in a series of tables, where each table contains the most relevant functions (according to the scope of this book) within that category.</p>';

echo <<<tbl
    <table border="1" style="text-align: left">
        <caption>Table 10: Array Functions Listing</caption>
    <thead>
        <tr style="text-align: center">
            <th>Function</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>array()</td>
            <td>Creates an array</td>
        </tr>
        <tr>
            <td>array_change_key_case()</td>
            <td>Returns an array with all keys either in lowercase or uppercase</td>
        </tr>
        <tr>
            <td>array_chunk()</td>
            <td>Splits an array into chunks of arrays</td>
        </tr>
        <tr>
            <td>array_combine()</td>
            <td>Creates an array by using one array for keys and another array for its values</td>
        </tr>
        <tr>
            <td>array_count_values()</td>
            <td>Returns an array with the number of occurrences for each value</td>
        </tr>
        <tr>
            <td>array_diff()</td>
            <td>Compares array values and returns the differences</td>
        </tr>
        <tr>
            <td>array_fill()</td>
            <td>Fills an array with values</td>
        </tr>
        <tr>
            <td>array_keys()</td>
            <td>Returns all keys of any array</td>
        </tr>
        <tr>
            <td>asort()</td>
            <td>Sorts an array and maintains index association</td>
        </tr>
        <tr>
            <td>arsort()</td>
            <td>Sorts an array in reverse order and maintains index association</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 11: Date and Time Functions Listing</caption>
    <thead>
        <tr style="text-align: center">
            <th>Function</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>date_date_set()</td>
            <td>Sets the date to a given date-time value</td>
        </tr>
        <tr>
            <td>date_format()</td>
            <td>Returns a formatted date according to a given format</td>
        </tr>
        <tr>
            <td>date_parse()</td>
            <td>Returns an associative array with detailed info about a given date</td>
        </tr>
        <tr>
            <td>date_time_set()</td>
            <td>Sets the time to a given value</td>
        </tr>
        <tr>
            <td>time_zone_indentifiers_list()</td>
            <td>Returns a numeric index array with all time zones identifiers</td>
        </tr>
        <tr>
            <td>date()</td>
            <td>Formats the local time/date</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 12: String Functions Listing</caption>
    <thead>
        <tr>
            <th>Function</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>strlen()</td>
            <td>Returns the length of a string</td>
        </tr>
        <tr>
            <td>strpos()</td>
            <td>Finds and returns the position of the first occurrence of a string within another string</td>
        </tr>
        <tr>
            <td>substr()</td>
            <td>Returns a part of a string</td>
        </tr>
        <tr>
            <td>ltrim()</td>
            <td>Removes white spaces or other characters from the beginning of a string</td>
        </tr>
        <tr>
            <td>rtrim()</td>
            <td>Removes white spaces or other characters from the end of a string</td>
        </tr>
        <tr>
            <td>str_repeat()</td>
            <td>Returns a repeated string</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 13: Character Functions Listing</caption>
    <thead>
        <tr>
            <th>Function</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ctype_alnum()</td>
            <td>Checks for alphanumeric characters in a string</td>
        </tr>
        <tr>
            <td>ctype_alpha()</td>
            <td>Checks for alphabetic characters in a string</td>
        </tr>
        <tr>
            <td>ctype_digit()</td>
            <td>Checks for numeric characters in a string</td>
        </tr>
        <tr>
            <td>ctype_lower()</td>
            <td>Checks for lowercase characters in a string</td>
        </tr>
        <tr>
            <td>crtype_upper()</td>
            <td>Checks for uppercase characters in a string</td>
        </tr>
        <tr>
            <td>ctype_cntrl()</td>
            <td>Check for control characters (such as Tab) in a string</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 14: File System Functions Listing</caption>
    <thead>
        <tr>
            <th>Function</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>copy()</td>
            <td>Creates a copy of a file</td>
        </tr>
        <tr>
            <td>delete()</td>
            <td>Deletes a file</td>
        </tr>
        <tr>
            <td>dirname()</td>
            <td>Returns the directory portion for a given path</td>
        </tr>
        <tr>
            <td>file()</td>
            <td>Reads an entire file into an array</td>
        </tr>
        <tr>
            <td>file_exists()</td>
            <td>Checks whether a file or directory exists</td>
        </tr>
        <tr>
            <td>basename()</td>
            <td>Returns the filename portion of a given path</td>
        </tr>
    </tbody>
</table>

<br />

<table border="1" style="text-align: left">
    <caption>Table 15: Directory Functions Listing</caption>
    <thead>
        <tr style="text-align: center">
            <th>Function</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>chdir()</td>
            <td>Changes the current directory</td>
        </tr>
        <tr>
            <td>dir()</td>
            <td>Opens a directory handle and returns an object</td>
        </tr>
        <tr>
            <td>closedir()</td>
            <td>Closes a directory previously opened with dir()</td>
        </tr>
        <tr>
            <td>getcwd()</td>
            <td>Returns the current working directory</td>
        </tr>
        <tr>
            <td>readdir()</td>
            <td>Reads an entry from a directory handle</td>
        </tr>
        <tr>
            <td>scandir()</td>
            <td>Returns a list of all files and directories inside a specified path</td>
        </tr>
    </tbody>
</table>

tbl;