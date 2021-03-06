
<h1>Manual</h1>

<p>This manual describes how to install, configure, and customize set of PHP scripts for the purpose of maintaining the TriLUG membership list. This document is designed to be printed and not necessarily read online.
</p>


<h2>Contents</h2>

<ol>
    <li>Introduction
    <li>Installation
    <li>Configuration
    <li>Customization
    <li>Commands
    <li>Future developments
    <li>Appendix A: Database structure
    <li>Appendix B: Credits
</ol>


<h2>Introduction</h2>

<p>
TriLUG is an acronym for Triangle Linux User Group, a not-for profit corporation created for sharing information about the Linux operating system. In order to best serve its members, TriLUG desires to maintain a list of its membership. This manual describes a set of PHP scripts, run through an HTTP server, designed for this purpose. The scripts assume the existence of a MySQL database backend. It is also assumes that files named index.php will automatically be executed by the HTTP server when no files are specified in a URL. This text does not describe how to install MySQL nor configure your HTTP server since these topics are beyond the scope of this document.
</p>


<h2>Installation</h2>

<p>
The scripts were distributed in a single .tar.gz file. Uncompress and untar the file with gunzip and tar, respectively. The result should be the creation of a directory (trilug) containing a bunch o' files. Copy or move the directory to a location where your HTTP server can find it. At this point you may want to re-configure your HTTP server to provide a bit of access control against the scripts as well as make sure index.php files are executed by default when no file names are specified in a URL.
</p>

<p>
The next step is to create the database to hold your data. To do this you will first want to decide what you want to call your database, what user name will have access to it, and what password the user name will use for authentication. Once you have decided these things, use the mysqladmin utility to create the database with a command looking something like this:
</p>

<blockquote>
<code>
mysqladmin -uroot -p create trilug_membership
</code>
</blockquote>

<p>
Next you will need to provide access to the database. There are probably many ways to do this, but I always use the MySQL client
as root and issue this sort of SQL statement:
</p>

<blockquote>
<code>
<pre>
mysql -uroot -p mysql
mysql> GRANT SELECT, INSERT, UPDATE, DELETE, CREATE
       ON trilug_membership.*
       TO nobody@localhost
       IDENTIFIED BY 'secret_password';
mysql> \q
</pre>
</code>
</blockquote>

<p>
Finally, you need to give the database some structure. In the distribution is a file named trilug_membership.sql containing the structure. Redirect this file to the MySQL client:
</p>

<blockquote>
<code>
mysql -uroot -p trilug_membership < trilug_membership.sql
</code>
</blockquote>

<p>
You should now be able to use the MySQL client to connect to the database and view its structure with simple EXPLAIN statements. If you can do this, then installation is complete.
</p>


<h2>Configuration</h2>

<p>
Once the database has been created and the scripts have been installed, you need to configure the scripts to allow access to the database, as well as a couple of other things. This is done by editing the system's index.php file, specifically, you <em>must</em> edit the values of the following variables:
</p>

<blockquote>
<dl>

    <dt>$gDatabase
    <dd>The name of the database where the membership data is saved

    <dt>$gUsername
    <dd>A username allowed to access the database

    <dt>$gPassword
    <dd>The password of username above

    <dt>$gHome
    <dd>The fully qualified root URL pointing to these scripts

    <dt>$gDate
    <dd>The date the scripts were last updated

    <dt>$gContactName
    <dd>The name of person who supports these scripts

    <dt>$gContactEmail
    <dd>the email address of the person above

</dl>
</blockquote>

<p>
After these variables have been defined no other configuration should be necessary. You will now probably want to customize the system's look-and-feel, and that process is described in the next section.
</p>


<h2>Customization</h2>

<p>
This system is made up .php files and .inc files. In general, the .php files include only PHP code and a tiny bit of HTML, and the .inc files contain mostly HTML with a smiggin of PHP. Put another way, most customization is done by editing the .inc files. Here is a list of the .inc files:
</p>

<blockquote>
<dl>

    <dt>add.inc
    <dd>This file contains the HTML form used for adding new members to the database.

    <dt>confirm.inc
    <dd>Before records are deleted, users are asked to confirm the decision to delete. The confirmation message is located in this file.

    <dt>delete.inc
    <dd>The output of the delete operation is contained here.

    <dt>displayall.inc
    <dd>This text is used to display abbreviated records listing all records in the database.

    <dt>displayone.inc
    <dd>This file displays all the information about a given member with options for editing or deleting.

    <dt>edit.inc
    <dd>The HTML form for editing records is contained in this file

    <dt>error.inc
    <dd>When an error occurs, a variable is set, this file is "included" in the system, and processing is stopped. This file presents the error message in a user-friendly fashion.

    <dt>footer.inc
    <dd>This is the HTML displayed at the end of all output. It is intended to contain the end BODY, the end HTML tag, and the contact information defined in the Configuration section.

    <dt>header.inc
    <dd>This is the HTML displayed at the beginning of all output. It is intended to contain any HEAD elements and the opening BODY tag.

    <dt>home.inc
    <dd>Enter into this file the content of the system's home page.

    <dt>manual.inc
    <dd>Here is the manual itself. You can edit it to correct my spellin' errors.

    <dt>results.inc
    <dd>The results of searches are displayed in this file. It is intended to look a lot like the content in displayall.inc.

    <dt>search.inc
    <dd>All information systems must be browsable and searchable. This include file contains the HTML allowing the user to create a <em>simple</em> SQL query against database.

</dl>
</blockquote>

<p>
The .inc files you will most likely want to edit are home.inc, header.inc, and footer.inc. Home.inc is the system's introductory page and intended to describe the scope of the system. Header.inc is the place where you can define the system's style information and/or remove the menu options from its initial side bar. The footer is intended to contain contact information in case the system goes bonkers and users want some technical support.
</p>

<p>
Here is a list of all the .php files:
</p>

<blockquote>
<dl>
    <dt>add.php</dt>
        <dd>This file is used to add a new member to the database.</dd>

    <dt>delete.php</dt>
        <dd>This file undoes the work of add.php; it removes records from the database.</dd>

    <dt>displayall.php</dt>
        <dd>Here is the code used to find all members and display a list of them.</dd>

    <dt>displayone.php</dt>
        <dd>This file is used to display a single record of a member in detail.</dd>

    <dt>edit.php</dt>
        <dd>This file allows you to edit records in the database.</dd>

    <dt>index.php</dt>
        <dd>This is a simple main sort of file and only is used to include other files.</dd>

    <dt>search.php</dt>
        <dd>This file allows you to do <em>very</em> simple searches against the database.</dd>
</dl>
</blockquote>

<p>
You <em>must</em> edit index.php in order for the system to work. This process was described in the Configuration section above. You might want to edit add.php to reduce the number of field requiring input.  If you edit add.php, then you will want to edit edit.php to jive with your changes.
</p>


<h2>Commands</h2>

<p>
The whole system is run by issuing one of seven commands specified in the URL. Each command is defined as such by preceeding it with a HTTP GET request prefixed with ?cmd=. For example, to display this manual, you would send the system a URL looking something like this:
</p>

<blockquote>
<code>
[path to membership directory]/?cmd=manual
</code>
</blockquote>

<p>
Here is a list of all the commands:
</p>

<blockquote>
<dl>
    <dt>add</dt>
        <dd>Used to display the form to add a member record.</dd>

    <dt>displayall</dt>
        <dd>Used to list all records in the database.</dd>

    <dt>displayone</dt>
        <dd>Used to display the record associated with a record number.</dd>

    <dt>delete</dt>
        <dd>Used delete a record.</dd>

    <dt>edit</dt>
        <dd>Used update the database.</dd>

    <dt>search</dt>
        <dd>Used to create a simple search against the database and display the results.</dd>

    <dt>manual</dt>
        <dd>Used to display this text.</dd>
</dl>
</blockquote>

<p>
If no command is supplied in the URL, then the contents of home.inc are displayed.
</p>

<p>
You may want to put relative URLs containing the add, displayall, search, and manual commands in your header.inc file so these functions are always available to your users. The other commands get automatically called by these command (with the exception of the manual command).
</p>


<h2>Future developments</h2>

<p>
Software is never done. It always seems to suffer from "creeping featuritis". The set of scripts is no exception. In fact, this system has been delivered knowing that a few things are missing. For example, TriLUG members ought to be able to edit their own records, and of course, not edit anybody else's. Consequently, there needs to be incorporated into the system more authentication and access control. Not everybody is just member of TriLUG; some members are also officers. These people need their records to reflect this fact. This membership database is flat, not relational. While this is not a problem now, it may become one later when more data is entered about each person.
</p>

<p>
With these things in mind, these scripts will need upgrading and most likely some maintenance.
</p>


<h2>Appendix A: Database structure</h2>

<p>
The database contains only one table with the following structure:
</p>

<blockquote>
<code>
<pre>
CREATE TABLE member_list (
   member_id bigint(20) unsigned NOT NULL,
   first_name varchar(30) NOT NULL,
   last_name varchar(30) NOT NULL,
   email varchar(254) NOT NULL,
   occupation varchar(30) NOT NULL,
   employer varchar(30) NOT NULL,
   birth_year int(4) NOT NULL,
   city varchar(30) NOT NULL,
   member_password varchar(30) DEFAULT 'password' NOT NULL,
   member_group varchar(30) DEFAULT 'member' NOT NULL,
   address_1 varchar(255) NOT NULL,
   address_2 varchar(255) NOT NULL,
   state char(2) DEFAULT 'NC' NOT NULL,
   zip_code varchar(10) NOT NULL,
   telephone varchar(15) NOT NULL,
   PRIMARY KEY (member_id),
   KEY member_id (member_id),
   UNIQUE member_id_2 (member_id)
);
</pre>
</code>
</blockquote>


<h2>Appendix B: Credits</h2>

These scripts were written by:

<blockquote>
Eric Lease Morgan<br>
Infomotions, Inc.<br>
219 Hawthorne Road<br>
Raleigh, NC 27605-1634<br>
<br>
919/833-1366<br>
<a href="mailto:eric_morgan@infomotions.com">eric_morgan@infomotions.com</a><br>
<a href="http://www.infomotions.com/">http://www.infomotions.com/</a><br>
<br>
December 7, 2000 (Pearl Harbor Day)
</blockquote>

<p>
But they would not have been written without the support and guidance of Kevin "The Alchemist" Sonney. "Thank you for the opportunity."
</p>


