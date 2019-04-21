# This my second laravel ecommerce application and this has set a base for movement through laravel php programming.

This is the link to the google drive location of the database https://drive.google.com/open?id=139Z5CzBpd_SXsWnhhiXQfpo009nG7gSr

How to use and run this project successfully
    - Follow the link above and download the mysql database of this project
    - Create a database name of your choice using phpmyadmin and import the downloaded copy to it.
    - Give user priviledges such as username and password to the database.
    - Go to the .env file in this project and change the username and password corresponding to the ones you gave to the database you just created
    
    - NOTE 
        - To grant all priviledges  to a database for a user you can run below command in the SQL section of the database in phpmyadmin server.
        
        COMMAND
        --------
        GRANT ALL PRIVILEDGES ON database_name.* TO 'user_name'@'localhost' IDENTIFIED BY 'user_password';
        
        ****** user_name = User name of your database
        ****** user_password = User Password of the database.
        Then in your .env file replace the database user/password with the one you just created.
        
        ****Link to .env file  https://drive.google.com/open?id=1RpNyVCSkXBWZhJn9T_a482pagU4n0Yjn, when downloaded change the name
        to .env
        
        ****** This is where you will replace the databaseName, DatabaseUserName, DatabasePassword. You are basically concerned 
        only with the database Name,username and password.  
        
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=YouDatabaseName
        DB_USERNAME=YourUserName
        DB_PASSWORD=YourPassword
        
        
        
        
