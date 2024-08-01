1. project set up (laravel-inertia-vue)
2. Breeze Authentication & Role management
=> user table changed 
=> Admin, Moderator and User registration by breeze

=>  Home controller, route and view create(without auth role)
->  HomeLayout create 

=> flowbite setup 
from flowbite .com
-> npm install flowbite
-> Change tailwind config(change plugins)
 require('flowbite/plugin')
 -> change content (add)
"./node_modules/flowbite/**/*.js"

-> import related page 
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
onMounted(() => {
    initFlowbite();
})


=> AdminController route and view create(without role)
-> AdminLayout create
=> Moderator route and view create (without role)
-> Moderator Layout create
=> User route and view create (without role)
-> User Layout
=> Role management (AuthenticatedSessionController )
  $url = '';
        if($request->user()->role === 'admin'){
            $url ='admin/dashboard';
        }elseif ($request->user()->role === 'instructor'){
            $url = 'instructor/dashboard';
        }elseif($request->user()->role === 'user'){
            $url = 'user/dashboard'; 
        }else{
            $url = '/';
        }
        return redirect()->intended($url);

=> middleware bind in app=>bootstrap=>app.php
 -> php artisan make:middleware Role
-> in Role file
     public function handle(Request $request, Closure $next, $role): Response
    {
       if($request ->user()->role !== $role){
        return redirect('/');
       }
       return $next($request); 
    }

=> add flash massage (HandleInertia request)
=> change database as admin, moderator and user 
=> authentication and role management complete 

=============complete auth and role management==========
3. Service and It training homepage create (route, controller)

=============Service Section=======

4. Category crud complete
5. Subcategory Crud complte 
6. User manage by Admin
7. Moderator profile and password update
8. Moderator projects crud(With multiple images)
=> Element plus org for multiple images
npm install element-plus --save
import ElementPlus from 'element-plus' (app.js)
.use(ElementPlus) ddd


     