# **<center>FAQ'S</center>**

# **Q1.** Who all can use this website?

**Ans:** a)**Admin:** For managing the website.                      
         b)**Transplant Coordinator:** A doctor from a registered hospital who performs a kidney transplant.  

# **Q2.** How to setup the project on your local machine?

**Ans:**  The [build documentation](https://github.com/siv2r/kidney-exchange/blob/master/docs/build.md)  provided in GitHub explains this in detail.

# **Q3.** What credentials are required to log in as a transplant coordinator?


**Ans:** Username:**test1** 
  
   Password: **test1**


# **Q4.** What credentials are required to log in as admin?

**Ans:** Username:**admin1**
 
 Password:**kep1**
     


# **Q5.** Why do the credentials provided in Q3 and Q4 are not working?

**Ans:** During login, the script checks the users’ table on the database to see if the provided login credentials are correct. Your database might be empty, so this will fail. Therefore, you must import `filled_kidney_exchange_data.sql` from the [manual setup](https://www.notion.so/Project-setup-Public-1a647ed8515c485f99f38e717acfa61b) document for the credential provided in Q3, Q4 to work.

# **Q6.** I am unable to find the hospital registration form on the website. What should I do?

**Ans:** You might have logged in using a transplant coordinator’s credentials (provided in Q3). Some features are invisible to the transplant coordinator since they are end-users and not a part of the development team. Login using admin credentials (provided in Q4). You can view the hospital registration form under register in the navbar.

# **Q7.** Global match (inside the match section in the nav bar) is not working.?

**Ans:** Run this command in root folder:
        `sudo chmod 777 global_match`
       
 This command sets the write permission as everyone for the global_match directory. Now the python script can write files/folders to the global_match directory. Hence, the Global match option in the website will work.

# **Q8.**  I am getting a **<ins>`hospital not registered`</ins>** error when I try to sign up. Why is this happening? 

**Ans:** As mentioned in Q1, this website is for the use of doctors from the hospital registered with us. So, you must enter a valid hospital id during signup. 