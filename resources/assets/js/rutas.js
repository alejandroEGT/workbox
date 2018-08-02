import Login from "./components/login";
import Registro from "./components/registro";
import Terminos from "./components/terminos";
import NotFound from './components/404.vue'
//loged
import Master from "./components/master";
import Home from "./components/Home/Home";
import Index from "./components/Home/Index";
import Chat from "./components/Home/chat";

import Proyecto from "./components/Home/proyecto"

let routes = [
{
    path: '/',
    component: Master,
    name:'Admin',
    redirect:'login',
    iconCls:'el-icon-message',
    meta:{auth:false},
    children:[
        {path: '/login',name: 'login',component: Login,meta: { auth: false }},
        {path: '/registro',name: 'registro',component: Registro,meta: { auth: false}},
        {path: '/terminos',name: 'terminos',component: Terminos,meta: { auth: false }},
    ]   
},

{
    path: '/home',
    component: Home,
    name: 'Administration',
    redirect:'index',
    iconCls: 'el-icon-message',
    meta: {auth: true},
    children: [
        { path: '/index', component: Index, name: 'Index' },
        { path: '/chat', component: Chat, name: 'Chat' },
        { path: '/proyecto/:id', component: Proyecto, name: 'Proyecto' },
    ]
},
{
        path: '/404',
        component: NotFound,
        name: '',
        hidden: true
    },
    {
        path: '*',
        hidden: true,
        redirect: { path: '/404' }
    }     


];

export default routes;