import{u as p,o as c,c as f,w as u,a,b as s,H as _,d as t,e as w,n as V,f as g}from"./app-ccc85bb8.js";import{_ as b}from"./GuestLayout-4fb351dd.js";import{_ as m,a as r}from"./InputLabel-116ba9e7.js";import{_ as v}from"./PrimaryButton-d52410c7.js";import{_ as n}from"./TextInput-d83a2d42.js";import"./ApplicationLogo-5ce5b8a9.js";import"./_plugin-vue_export-helper-c27b6911.js";const h=["onSubmit"],x={class:"mt-4"},k={class:"mt-4"},y={class:"mt-4"},U={class:"mt-4"},q={class:"mt-4"},C={class:"mt-4"},N={class:"mt-4"},$={class:"mt-4"},P={class:"flex items-center justify-end mt-4"},E={__name:"Register",setup(B){const e=p({username:"",name:"",email:"",password:"",password_confirmation:"",phone:"",ic_number:"",alamat:"",terms:!1}),d=()=>{e.phone=e.phone.replace(/[^0-9 ]/g,""),e.phone.substring(0,1)!=="6"&&(e.phone="6"+e.phone),e.ic_number=e.ic_number.replace(/[^0-9 ]/g,"");const i=e.name.split(" ");e.name=i.map(o=>o[0].toUpperCase()+o.substring(1).toLowerCase()).join(" "),e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(i,o)=>(c(),f(b,null,{default:u(()=>[a(s(_),{title:"Register"}),t("form",{onSubmit:g(d,["prevent"])},[t("div",x,[a(m,{for:"username",value:"Username"}),a(n,{id:"username",type:"text",class:"mt-1 block w-full",modelValue:s(e).username,"onUpdate:modelValue":o[0]||(o[0]=l=>s(e).username=l),required:"",autocomplete:"username"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.username},null,8,["message"])]),t("div",k,[a(m,{for:"name",value:"Nama"}),a(n,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":o[1]||(o[1]=l=>s(e).name=l),required:"",autocomplete:"name"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),t("div",y,[a(m,{for:"email",value:"Email"}),a(n,{id:"email",type:"text",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[2]||(o[2]=l=>s(e).email=l),required:"",autocomplete:"email",password:""},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",U,[a(m,{for:"password",value:"Password"}),a(n,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[3]||(o[3]=l=>s(e).password=l),required:"",autocomplete:"password",password:""},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),t("div",q,[a(m,{for:"password_confirmation",value:"Password Confirmation"}),a(n,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":o[4]||(o[4]=l=>s(e).password_confirmation=l),required:"",autocomplete:"password_confirmation"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),t("div",C,[a(m,{for:"phone",value:"Phone"}),a(n,{id:"phone",type:"text",class:"mt-1 block w-full",modelValue:s(e).phone,"onUpdate:modelValue":o[5]||(o[5]=l=>s(e).phone=l),required:"",autocomplete:"phone"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.phone},null,8,["message"])]),t("div",N,[a(m,{for:"ic_number",value:"No K/P"}),a(n,{id:"ic_number",type:"text",class:"mt-1 block w-full",modelValue:s(e).ic_number,"onUpdate:modelValue":o[6]||(o[6]=l=>s(e).ic_number=l),autocomplete:"ic_number"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.ic_number},null,8,["message"])]),t("div",$,[a(m,{for:"alamat",value:"Alamat"}),a(n,{id:"alamat",type:"text",class:"mt-1 block w-full",modelValue:s(e).alamat,"onUpdate:modelValue":o[7]||(o[7]=l=>s(e).alamat=l),autocomplete:"alamat"},null,8,["modelValue"]),a(r,{class:"mt-2",message:s(e).errors.alamat},null,8,["message"])]),t("div",P,[a(v,{class:V(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:u(()=>[w(" Register ")]),_:1},8,["class","disabled"])])],40,h)]),_:1}))}};export{E as default};
