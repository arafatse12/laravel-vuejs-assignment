
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;


 //department cmponent
 let department = require('./components/department/index.vue').default;
 let storedepartment = require('./components/department/create.vue').default;
 let editdepartment = require('./components/department/edit.vue').default;
 //student cmponent
 let student = require('./components/student/index.vue').default;
 let storestudent = require('./components/student/create.vue').default;
 let editstudent = require('./components/student/edit.vue').default;

  //result cmponent
  let result = require('./components/result/index.vue').default;
  let storeresult = require('./components/result/create.vue').default;
  let editresult = require('./components/result/edit.vue').default;


let home = require('./components/home.vue').default;


export const routes = [
  { path: '/', component: login, name:'/' },
  { path: '/register', component: register , name:'register' },
  { path: '/forget', component: forget , name:'forget' },
  { path: '/logout', component: logout , name:'logout' },
  { path: '/home', component: home , name:'home' },

   //department routes--
   { path: '/store-department', component: storedepartment, name:'store-department' },
   { path: '/department', component: department, name:'department' },
   { path: '/edit-department/:id', component: editdepartment, name:'edit-department' },

    //student routes--
  { path: '/store-student', component: storestudent, name:'store-student' },
  { path: '/student', component: student, name:'student' },
  { path: '/edit-student/:id', component: editstudent, name:'edit-student' },

   //result routes--
   { path: '/store-result', component: storeresult, name:'store-result' },
   { path: '/result', component: result, name:'result' },
   { path: '/edit-result/:id', component: editresult, name:'edit-result' },

]
