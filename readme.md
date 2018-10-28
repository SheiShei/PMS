<p><strong>Step 1: </strong>run 'composer update'</p>
<p><strong>Step 2: </strong>run 'composer dumpautoload'</p>
<p><strong>Step 3: </strong>run 'php artisan migrate:fresh --seed'</p>
<p><strong>Step 4: </strong>run 'php artisan passport:install' and copy the second client secret</p>
<p><strong>Step 5: </strong>go to .env and add</p>

          PASSPORT_LOGIN_ENDPOINT="http://name_of_app.test/"
          PASSPORT_CLIENT_ID=2
          PASSPORT_CLIENT_SECRET=paste here the client secret

<p><strong>Step 6 </strong>run 'npm install </p> 

          ***sample account
                    email: 'test@test.com'
                    password: 'testpass'
