<h1 align="center">Hello Everyone 👋</h1>
<h2 align="center">Welcome to the <a href="https://github.com/siv2r/kidney-exchange">kidney-exchange</a> Repo 🎉</h2>

<h2 align="center">Here is the Complete Guide on how to do the project setup</h2>

<h3>Docker Method(For Frontend Part)</h3>
<br>

  ## How to run the server (Optional)

1. Install Docker

2. Run ```docker-compose up``` inside the project root folder

3. Now you should be able to access the project at 0.0.0.0:8080 or localhost:8080 and then you should 
   just refresh the page to see your changes.

<h3>Manual Setup Method(For Backend part)</h3>
<br>

 1. Clone the project from github - [Here](https://github.com/siv2r/kidney-exchange)

 2. Install XAMPP (or LAMPP stack)

 3. Place the project folder under the <lampp/htdocs> directory in XAMPP. In Linux, the path might 
    look like </opt/lampp/htdocs/kidney_exchange>

 4. Start the XAMPP server and go to localhost on your browser to view the website

 5. Import the table data to the database

    5.1  Go to [http://localhost/phpmyadmin/index.php](http://localhost/phpmyadmin/index.php)
       create a new database and import the file below. See [here](https://www.youtube.com/watch?v=jW5lrS6EUPM) for more info

        ## [empty_kidney_exchange_data.sql](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/aadb6e18-e704-4b9c-8149-5816cee18bcd/kidney_exchange.sql)

    5.2 The file below has some date entered into it.

        ## [filled_kidney_exchange_data](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/30ce5988-7352-40ff-9806-831af7dde1d0/kidney_exchange.sql)   

  6. Connect to database server 

      6.1  Create a new user account. See [here](https://www.youtube.com/watch?v=zpTlJ6dtOxA& 
        list=PL4cUxeGkcC9gksOX3Kd9KPo-O68ncT05o&index=25) for more info.

      6.2 Update the `project_name/templates/db-connect.php` file as shown below.

    ```php
    $servername = "localhost";
    $username = "some_usr"; -----> change this to the username used in step 5.1
    $password = "some_pswd"; ----> change to the password used in step 5.1
    $dbname = "kidney_exchange";---> change to the database name used in step 4.2
    ```

    7. Set limit for max allowed packet to 2 MB in your SQL database (Default value is 1 MB)


<h1 align="center"> Happy Coding 💻</h1>
     


          
   

   