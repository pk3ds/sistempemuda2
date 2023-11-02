import{u as b,o as l,c as d,w as m,a as t,b as s,H as k,g as x,t as y,h as u,d as a,L as h,e as i,n as v,f as V}from"./app-e687a8f9.js";import{_ as $}from"./Checkbox-e0c5fea4.js";import{_ as B}from"./GuestLayout-39777d98.js";import{_ as c,a as f}from"./InputLabel-12d989a5.js";import{_ as L}from"./PrimaryButton-45823b16.js";import{_ as p}from"./TextInput-8c65de31.js";import{_ as R}from"./SecondaryButton-a565e39c.js";import"./ApplicationLogo-5c43f49c.js";import"./_plugin-vue_export-helper-c27b6911.js";const C={key:0,class:"mb-4 font-medium text-sm text-green-600"},N=["onSubmit"],S={class:"mt-4"},U={class:"block mt-4"},q={class:"flex items-center"},F=a("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),P={class:"flex items-center justify-end mt-4"},I={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(n){const e=b({username:"",password:"",remember:!1}),_=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})},g=()=>{window.location="register"};return(w,o)=>(l(),d(B,null,{default:m(()=>[t(s(k),{title:"Login"}),n.status?(l(),x("div",C,y(n.status),1)):u("",!0),a("form",{onSubmit:V(_,["prevent"])},[a("div",null,[t(c,{for:"username",value:"Username"}),t(p,{id:"username",type:"text",class:"mt-1 block w-full",modelValue:s(e).username,"onUpdate:modelValue":o[0]||(o[0]=r=>s(e).username=r),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(f,{class:"mt-2",message:s(e).errors.username},null,8,["message"])]),a("div",S,[t(c,{for:"password",value:"Password"}),t(p,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[1]||(o[1]=r=>s(e).password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(f,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),a("div",U,[a("label",q,[t($,{name:"remember",checked:s(e).remember,"onUpdate:checked":o[2]||(o[2]=r=>s(e).remember=r)},null,8,["checked"]),F])]),a("div",P,[n.canResetPassword?(l(),d(s(h),{key:0,href:w.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>[i(" Forgot your password? ")]),_:1},8,["href"])):u("",!0),t(L,{class:v(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:m(()=>[i(" Log in ")]),_:1},8,["class","disabled"]),t(R,{class:"ml-4",onClick:o[3]||(o[3]=r=>g())},{default:m(()=>[i(" Register ")]),_:1})])],40,N)]),_:1}))}};export{I as default};