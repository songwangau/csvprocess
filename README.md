PHP Task:
CSV process and store data into DB

Main.php is entry for the application.

Script Command Line Directives:

create_table: 
  php main.php --create_table -u root -p root -h localhost

dry_run:
  php main.php --dry_run --file ./users.csv

file:
  php main.php --file ./users.csv -u root -p root -h localhost
  
help:
  php main.php or php main.php --help
