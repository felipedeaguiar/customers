# customers

# requirements
  - docker
  

# install back end

 1. cd essential-app
 2. create alias to sail, run in terminal:
  `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail`
 3. run `sail up`
 4. `sail artisan storage:link`
 5. `sail artisan migrate`

# install front

 1. cd essential-front
 2. `npm install`
 3. `npm run dev`
  
