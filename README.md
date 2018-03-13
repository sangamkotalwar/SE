# Software-Engineering-Project-2017
Code Utility Software - Software Engineering Project for B.Tech 3rd batch of CSE at NIIT University, Neemrana, India

<h2><b>Software Requirement Specification</b></h2><hr/>
We all go through the trouble of googling about any function, data type or syntax while coding while learning a new programming language. 
Programming Assistant is a Web App where the user can search a keyword/task and get all the help about it with a code snippet and description, in whichever language user chooses from the ones provided by the system. The user can even ask questions like how can we validate a password and get the description and code snippet for the same. It can be used by him/her while coding! The search time is also reduced as when you search on Google, it provides references to multiple sites to get a single working solution! This app also provides the user (who must be logged in) with the option to save all their codes and functions made by them which will work as a guide for them in future. The user can even share his snippets with his friends as well as publically (i.e. making it visible to all registered users).

The main motto of Programming Assistant system is to allow any programmer irrespective of his knowledge and experience, to store (only registered users) and search all his learning and building experiences and being able to share them with other people who can use that knowledge to increase theirs. The main motive is that the user does not have to search for the same thing twice.

<h2><b>Software Design Specification</b></h2><hr/>
It is multi-user web app, future extensions may include functionalities like sending share requests to other users, if a user wants something from another user. A voting functionality can also be introduced so that the search results will give only highly rated snippets as output.

MVC i.e. Model View Controller is one of the most widely used frameworks to design any web app. It separates the whole web app into certain sections which are easy to understand, develop andmaintain or in other words it helps structure the code-base.

This application will require any appropriate web browser that supports HTML 5, CSS and JavaScript.

From the beginning we set a goal to make use of any existing code to avoid wasting time duplicating other’s work. We also decided to use open source or freeware solutions wherever possible. Since we are creating a web application, it is possible to use all the web development tools available through the development community. It was obvious for us to go with HTML, CSS and Java Script for the front-end as it is ubiquitous in almost all the web applications. As database manipulation is one of the key features of our WebApp, we chose PHP as our back-end language along with Microsoft SQL Server 2014.

In the early stages of design, we chose to restrict the WebApp to only registered users, but later on extended it by allowing Guest Users to carry out the search in system’s database. Keeping in mind the time span we have to develop the project, we left out the idea of ranking system which would allow other users to rate other user’s public data for better references.
