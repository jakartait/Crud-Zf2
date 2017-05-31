@ECHO OFF

mkdir EXPORT
call .\vendor\bin\doctrine-module orm:convert-mapping --force --from-database annotation ./EXPORT/


pause 