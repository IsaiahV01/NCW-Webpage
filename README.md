# NCW-Webpage
Capstone Project containing all the files plus a README file with instructions and a link to the AMPPS webpage so all files can be properly displayed. 
This is a local host project net yet designed to be a webpage on a domain.

From personal tests, this ran on AMPPS localhost servers and they did not work on a regular browser because it utilized PHP.

Here's a link to download AMPPS if you do not have it already, it is free:

https://ampps.com/

After downloading and running the app using the ampps.exe, extract the zipfile into the "www" folder in Ampps, then IMPORT the database, then on the Ampps popup window, press the globe image. 

If needed, click on the folder on the localhost webpagepopup named "Capstone". It should properly open the webpage


---  IMPORT DATABASE ---

There is a file in the Capstone folder called ncw_database.
To import that database onto your localhost server, press the home icon on the AMPPS popup window then:

- Select "Add Database" under Database Tools
- Login using default access authorization (Username: root) (Password: mysql)
- Select "Import" from the top menu bar (Page Icon with a red arrow pointing left)
- Select "Choose File" and browse to find the ncw_database file
- After you see the file is selected, scroll down and select the import button

After doing this it should automatically make the correct tables and populate your databases with demo information.

------


--- UTILIZATION ---

- Some features of the "customer" side. -
  You are able to create an account using the Sign-Up page in the top right. Ensure all data is correct
  OR
  You can log in using the premade demo/test accounts Username/Password: demo  Username/Password: test, respectively.
  Using the Login page, also in the top right.

Once logged in you will be able to view all events that are approved by administration on the events page.
On the about page is where logged in users can request to schedule an event using the Request Event button and filling out its form.
--

- Some Features of the "administration" side. -
  You are able to AUTHENTICATE a user to access the admin screen in the database or use the premade admin account Username/Password: admin

  If a user is an authenticated admin, once they log in they will see the administration page where they can see 4 areas of webpage information:
  
  - UNAPPROVED EVENTS
    - with each entry having a APPROVE and DELETE button
      
  - APPROVED WEDDING EVENTS
    - with each entry having a DELETE button
      
  - APPROVED WINE TASTING EVENTS
    - with each entry having a DELETE button
      
  - APPROVED PRIVATE EVENTS
    - with each entry having a DELETE button
   
Approved event (on click) will automatically move the entry to it's respective location in the admin page AND will appear on the Events webpage for everyone to see.
Deleted event (on click) will automatically be REMOVED PERMANENTLY from the admin page / Events webpage / database.
      

- AUTHENTICATE AN ADMIN -

  - Within the phpMyAdmin screen select the "ncw_database" on the left side of the screen
  - Then select the table named "account"
  - Within the row of the account you wish to make an admin, select Edit ("Pencil Icon" Edit)
  - Scroll down to the " admin | int | dropbox v | 0 " area
  - Change the 0 to a 1 and select the "Go" button
    
--

------


