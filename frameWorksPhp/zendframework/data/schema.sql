/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  luiscarlosss
 * Created: 11 de abr. de 2020
 */

CREATE TABLE album (
id INTEGER PRIMARY KEY AUTOINCREMENT,
artist varchar(100) NOT NULL,
title varchar(100) NOT NULL);

INSERT INTO album (artist, title) VALUES ('Bruce Springsteen', 'Born To Die');
INSERT INTO album (artist, title) VALUES ('The Military Wives', 'In My Dreams');
INSERT INTO album (artist, title) VALUES ('Adele', '21');
INSERT INTO album (artist, title) VALUES ('Lana Del Rey', 'Wrecking Ball (Deluxe)');
INSERT INTO album (artist, title) VALUES ('Gotye', 'Making Mirrors');

```
(The test data chosen happens to be the Bestsellers on Amazon UK at the time of writing!)

Now create the database using the following:

```bash

$ sqlite data/zafutorial.db < data/schema.sql

Some systems, including Ubuntu, use the command `sqlite3`; check to see which one to use on your system.

### Using PHP to create the database

If you do not have Sqlite inslalled on your system, you can use PHP to load the database using the same SQL schema file created earlier. Create the file `data/load_db.php` with the follo9wing contents:

$$$$FENCED_CODE_BLOCK_5e309194218981.17847134

Once created, execute it:

$$$$FENCED_CODE_BLOCK_5e309194218ab7.15433973

We now have some data in a database and can write a very simple model for it.

## The model files

Zend Framework does not provide a zend-model component because the model is your
business logic, and it's up to you to decide how you want it to work. There are
many components that you can use for this depending on your needs. One approach
is to have model classes represent each entity in your application and then use
mapper objects that load and save entities to the database. Another is to use an
Object-Relational Mapping (ORM) technology, such as Doctrine or Propel.

For this tutorial, we are going to create a model by creating an `AlbumTable`
class that consumes a `Zend\Db\TableGateway\TableGateway`, and in which each
album will be represented as an `Album` object (known as an *entity*). This is
an implementation of the [Table Data Gateway](http://martinfowler.com/eaaCatalog/tableDataGateway.html)
design pattern to allow for interfacing with data in a database table. Be aware,
though, that the Table Data Gateway pattern can become limiting in larger
systems. There is also a temptation to put database access code into controller
action methods as these are exposed by `Zend\Db\TableGateway\AbstractTableGateway`.
*Don't do this*!