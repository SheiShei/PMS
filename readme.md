Login
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/1%20-%20Login.png" />        <br>
Dashboard <br>
**ACMA (project manager)
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/2%20-%20Dashboard%20ACMA.png" />  
**Admin
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/2%20-%20Dashboard%20Admin.PNG" />
**Client
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/2%20-%20Dashboard%20Client.PNG" /> 
**Employee
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/2%20-%20Dashboard%20Employee.png" /> 
 <br>
Profile and Account Settings
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/3%20-%20Profile%20and%20Account%20Settings.png" />
 <br>
Users
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/4%20-%20Users.PNG" />
 <br>
Brands
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/5%20-%20Brands.PNG" />
 <br>
Add Brand
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/6%20-%20Add%20Brand.PNG" />
 <br>
Workbook
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/7%20-%20Workbook.PNG" />
 <br>
Create Workbook
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/8%20-%20Create%20Workbook.PNG" />
 <br>
Messages
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/9%20-%20Messages.PNG" />
 <br>
Brand Profile
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/10%20-%20Brand%20Profile.PNG" />
 <br>
Create Job Order
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/11%20-%20Create%20Web%20Job%20Order.png" />
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/12%20-%20Create%20Creatives%20Job%20Order.png" />
 <br>
View Workbook
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/13%20-%20View%20Workbook.png" />
 <br>
Add Revision
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/14%20-%20Add%20Revision%20Workbook.png" />
 <br>
Client Review
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/15%20-%20Client%20Review%20Workbook.png" />
 <br>
Job Orders
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/16%20-%20Job%20Orders.png" />
 <br>
View Job order
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/17%20-%20View%20Job%20Orders.png" />
 <br>
Boards
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/18%20-%20Boards.png" />
 <br>
Scrum Board Backlog
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/19%20-%20Scrum%20Board%20Backlog.png" />
 <br>
Sprint Backlog
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/20%20-%20Sprint%20Backog.PNG" />
 <br>
Sprint Burndown Chart
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/21%20-%20Sprint%20Burndown%20Chart%20Statistics.PNG" />
 <br>
Sprint Cummulative Chart
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/22%20-%20Sprint%20Cumulative%20Chart.PNG" />
 <br>
Board Details
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/23%20-%20Board%20Details.PNG" />
 <br>
Board Settings
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/24%20-%20Board%20Settings.PNG" />
 <br>
Kanban Board Backlog
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/25%20-%20Kanban%20Board%20Backlog.PNG" />
 <br>
Workload
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/26%20-%20Workload.PNG" />
 <br>
Sticky Notes
<img src="https://github.com/SheiShei/Captivate/blob/master/Views/27%20-%20Sticky%20Notes.PNG" />


<p><strong>Step 1: </strong>run 'composer update'</p>
<p><strong>Step 2: </strong>run 'composer dumpautoload'</p>
<p><strong>Step 3: </strong>run 'php artisan migrate:fresh --seed'</p>
<p><strong>Step 4: </strong>run 'php artisan passport:install' and copy the second client secret</p>
<p><strong>Step 5: </strong>go to .env and add</p>

          PASSPORT_LOGIN_ENDPOINT="http://name_of_app.test/"
          PASSPORT_CLIENT_ID=2
          PASSPORT_CLIENT_SECRET=paste here the client secret

<p><strong>Step 6 </strong>run 'npm install </p> 
<p><strong>Step 7 </strong>Login </p> 

          ***sample account
                    email: 'test@test.com'
                    password: 'testpass'
