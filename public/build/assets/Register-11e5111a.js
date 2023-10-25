import{u as d,o as p,c,w as i,a,b as s,H as f,d as m,e as _,n as w,f as V}from"./app-2fb842ab.js";import{_ as g}from"./GuestLayout-4011708c.js";import{_ as t,a as r}from"./InputLabel-f31c21aa.js";import{_ as b}from"./PrimaryButton-fd5c32fb.js";import{_ as n}from"./TextInput-10363572.js";import"./ApplicationLogo-7ef6d5ae.js";import"./_plugin-vue_export-helper-c27b6911.js";const v=["onSubmit"],h={class:"mt-4"},x={class:"mt-4"},k={class:"mt-4"},y={class:"mt-4"},U={class:"mt-4"},q={class:"mt-4"},N={class:"mt-4"},$={class:"mt-4"},P={class:"flex items-center justify-end mt-4"},E={__name:"Register",setup(B){const e=d({username:"",name:"",email:"",password:"",password_confirmation:"",phone:"",ic_number:"",alamat:"",terms:!1}),u=()=>{e.phone=e.phone.replace(/[^0-9 ]/g,""),e.phone.substring(0,1)!=="6"&&(e.phone="6"+e.phone),e.ic_number=e.ic_number.replace(/[^0-9 ]/g,""),e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(C,o)=>(p(),c(g,null,{default:i(()=>[a(s(f),{title:"Register"}),m("form",{onSubmit:V(u,["prevent"])},[m("div",h,[a(t,{for:"username",value:"Username"}),a(n,{id:"username",type:"text",class:"mt-1 block w-full",modelValue:s(e).username,"onUpdate:modelValue":o[0]||(o[0]=l=>s(e).username=l),required:"",autocomplete:"username"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.username},null,8,["message"])]),m("div",x,[a(t,{for:"name",value:"Nama"}),a(n,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":o[1]||(o[1]=l=>s(e).name=l),required:"",autocomplete:"name"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),m("div",k,[a(t,{for:"email",value:"Email"}),a(n,{id:"email",type:"text",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[2]||(o[2]=l=>s(e).email=l),required:"",autocomplete:"email",password:""},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),m("div",y,[a(t,{for:"password",value:"Password"}),a(n,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[3]||(o[3]=l=>s(e).password=l),required:"",autocomplete:"password",password:""},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),m("div",U,[a(t,{for:"password_confirmation",value:"Password Confirmation"}),a(n,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":o[4]||(o[4]=l=>s(e).password_confirmation=l),required:"",autocomplete:"password_confirmation"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),m("div",q,[a(t,{for:"phone",value:"Phone"}),a(n,{id:"phone",type:"text",class:"mt-1 block w-full",modelValue:s(e).phone,"onUpdate:modelValue":o[5]||(o[5]=l=>s(e).phone=l),required:"",autocomplete:"phone"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.phone},null,8,["message"])]),m("div",N,[a(t,{for:"ic_number",value:"No K/P"}),a(n,{id:"ic_number",type:"text",class:"mt-1 block w-full",modelValue:s(e).ic_number,"onUpdate:modelValue":o[6]||(o[6]=l=>s(e).ic_number=l),autocomplete:"ic_number"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.ic_number},null,8,["message"])]),m("div",$,[a(t,{for:"alamat",value:"Alamat"}),a(n,{id:"alamat",type:"text",class:"mt-1 block w-full",modelValue:s(e).alamat,"onUpdate:modelValue":o[7]||(o[7]=l=>s(e).alamat=l),autocomplete:"alamat"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.alamat},null,8,["message"])]),m("div",P,[a(b,{class:w(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:i(()=>[_(" Register ")]),_:1},8,["class","disabled"])])],40,v)]),_:1}))}};export{E as default};