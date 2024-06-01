import{o as i,g as _,i as v,u as x,c,w as l,a as t,b as s,H as y,t as k,h as u,d as a,L as $,e as m,n as V,f as B}from"./app-ccc85bb8.js";import{_ as C}from"./Checkbox-4102ff2b.js";import{_ as L}from"./GuestLayout-4fb351dd.js";import{_ as f,a as p}from"./InputLabel-116ba9e7.js";import{_ as R}from"./PrimaryButton-d52410c7.js";import{_ as g}from"./TextInput-d83a2d42.js";import{_ as S}from"./SecondaryButton-c55488da.js";import"./ApplicationLogo-5ce5b8a9.js";import"./_plugin-vue_export-helper-c27b6911.js";const z={class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"},H=v('<svg class="fill-current w-4 h-4 mr-2" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg"><path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"></path><path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"></path><path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04"></path><path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"></path></svg><span>Login with Google</span>',2),M=[H],N={__name:"GoogleButton",props:{type:{type:String,default:"button"}},setup(n){return(e,d)=>(i(),_("button",z,M))}},U={key:0,class:"mb-4 font-medium text-sm text-green-600"},q=["onSubmit"],F={class:"mt-4"},P={class:"block mt-4"},j={class:"flex items-center"},G=a("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),D={class:"flex items-center justify-between mt-4"},E={class:"flex items-center justify-end mt-4"},Y={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(n){const e=x({username:"",password:"",remember:!1}),d=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})},w=()=>{window.location="register"},h=()=>{window.location="auth/google"};return(b,o)=>(i(),c(L,null,{default:l(()=>[t(s(y),{title:"Login"}),n.status?(i(),_("div",U,k(n.status),1)):u("",!0),a("form",{onSubmit:B(d,["prevent"])},[a("div",null,[t(f,{for:"username",value:"Username"}),t(g,{id:"username",type:"text",class:"mt-1 block w-full",modelValue:s(e).username,"onUpdate:modelValue":o[0]||(o[0]=r=>s(e).username=r),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(p,{class:"mt-2",message:s(e).errors.username},null,8,["message"])]),a("div",F,[t(f,{for:"password",value:"Password"}),t(g,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[1]||(o[1]=r=>s(e).password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(p,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),a("div",P,[a("label",j,[t(C,{name:"remember",checked:s(e).remember,"onUpdate:checked":o[2]||(o[2]=r=>s(e).remember=r)},null,8,["checked"]),G])]),a("div",D,[a("div",null,[n.canResetPassword?(i(),c(s($),{key:0,href:b.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:l(()=>[m(" Forgot your password? ")]),_:1},8,["href"])):u("",!0)]),a("div",null,[t(R,{class:V(["ml-2",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:l(()=>[m(" Log in ")]),_:1},8,["class","disabled"]),t(S,{class:"ml-2",onClick:o[3]||(o[3]=r=>w())},{default:l(()=>[m(" Register ")]),_:1})])])],40,q),a("div",E,[t(N,{onClick:o[4]||(o[4]=r=>h())})])]),_:1}))}};export{Y as default};
