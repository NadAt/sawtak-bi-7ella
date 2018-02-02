# sawtak-bi-7ella
This web application was created as a final year project. The goal of this application is to crowd-source  information about the problems that people face in Lebanon. We believe that the collection of this data will allow officials to be more aware about people's problems and take action to solve them. 

User Side:

  LandingPage --> index.php
  This is the main page of the web-application. It's basically divided into two sections:
  1) The first section displays all the problems reported in a form of a container, showing the title, image and the date the report was      issued.
  2) The second section displays those reports as markers on a map, where each marker represents one report.

  ReportProblem --> reportProblem.php
  This is the page where a user can issue a report regarding a problem they noticed.
  Again, this section is divided into two sections:
  The first section is in a form of a table which users should fill. It contains fields as title, category the problem lies in, a summary   about the problem, images if any.
  The second section is a map having the user’s default location marked. The user can choose to either keep it that way if they’re in the   same destination as the problem. Or they can choose a different location if they’re reporting it from elsewhere. 

  Sign_in-page --> signIn.php

  Help -> help.php

Admin side:

  All the reports issued go to the admin side to be approved before being displayed for the rest of the users to view.

  FYP --> prepareMaps.php 
  This is the admin side. An admin can view all reports and filter through them based on specific criteria (location, category or date).      An admin can also export a csv file containing all the reports 

  FYP --> homeAdmin.html
