import{u as v,o as d,g as u,a as e,b as l,w as c,F as g,H as w,e as p,h as _,d as s,f as x,j as b,t as V,c as k}from"./app-d8e3cca8.js";import{_ as C}from"./AuthenticatedLayout-7dfd9ca4.js";import{_ as n,a as i}from"./InputLabel-ca6ea866.js";import{_ as f}from"./TextInput-5290bbc7.js";import{_ as $}from"./SelectInput-4fa0c95f.js";import{_ as U}from"./PrimaryButton-a81a273a.js";import{_ as B}from"./SecondaryButton-d637519c.js";import"./ApplicationLogo-17fb9362.js";import"./_plugin-vue_export-helper-c27b6911.js";const E={key:0,class:"bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full",role:"alert"},N=s("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"exclamation-triangle",class:"w-4 h-4 mr-2 fill-current",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512"},[s("path",{fill:"currentColor",d:"M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"})],-1),j={class:"pt-8 pb-2"},q={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"},z={class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},F=s("header",null,[s("h2",{class:"text-lg font-medium text-gray-900"},"Edit Committee"),s("p",{class:"mt-1 text-sm text-gray-600"}," View or edit committees for the event. ")],-1),H=["value"],M={class:"flex items-center gap-4"},I={__name:"Edit",props:{user:Object,roles:Object},setup(r){const m=r;function h(){window.history.back()}const a=v({name:m.user.name,username:m.user.username,email:m.user.email,phone:m.user.phone,role_id:m.user.roles[0].id});return(y,o)=>(d(),u(g,null,[e(l(w),{title:"Edit Committee"}),e(C,null,{default:c(()=>[r.user.deleted_at?(d(),u("div",E,[N,p(" This user has been deleted from the system, all records are for viewing only ")])):_("",!0),s("div",j,[s("div",q,[s("div",z,[s("section",null,[F,s("form",{onSubmit:o[5]||(o[5]=x(t=>l(a).patch(y.route("committees.update",r.user)),["prevent"])),class:"mt-6 space-y-6"},[s("div",null,[e(n,{for:"name",value:"Name"}),e(f,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:l(a).name,"onUpdate:modelValue":o[0]||(o[0]=t=>l(a).name=t),required:"",readonly:r.user.deleted_at,autofocus:"",autocomplete:"name"},null,8,["modelValue","readonly"]),e(i,{class:"mt-2",message:l(a).errors.name},null,8,["message"])]),s("div",null,[e(n,{for:"username",value:"Username"}),e(f,{id:"username",type:"text",class:"mt-1 block w-full",modelValue:l(a).username,"onUpdate:modelValue":o[1]||(o[1]=t=>l(a).username=t),readonly:r.user.deleted_at,autocomplete:"username"},null,8,["modelValue","readonly"]),e(i,{class:"mt-2",message:l(a).errors.username},null,8,["message"])]),s("div",null,[e(n,{for:"email",value:"Email"}),e(f,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:l(a).email,"onUpdate:modelValue":o[2]||(o[2]=t=>l(a).email=t),readonly:r.user.deleted_at,autocomplete:"email"},null,8,["modelValue","readonly"]),e(i,{class:"mt-2",message:l(a).errors.email},null,8,["message"])]),s("div",null,[e(n,{for:"phone",value:"Phone"}),e(f,{id:"phone",type:"text",class:"mt-1 block w-full",modelValue:l(a).phone,"onUpdate:modelValue":o[3]||(o[3]=t=>l(a).phone=t),readonly:r.user.deleted_at,autocomplete:"phone",required:""},null,8,["modelValue","readonly"]),e(i,{class:"mt-2",message:l(a).errors.phone},null,8,["message"])]),s("div",null,[e(n,{for:"role_id",value:"Role"}),e($,{id:"role_id",class:"mt-1 block w-full",modelValue:l(a).role_id,"onUpdate:modelValue":o[4]||(o[4]=t=>l(a).role_id=t),required:"",disabled:r.user.deleted_at},{default:c(()=>[(d(!0),u(g,null,b(r.roles,t=>(d(),u("option",{value:t.id},V(t.name),9,H))),256))]),_:1},8,["modelValue","disabled"]),e(i,{class:"mt-2",message:l(a).errors.role_id},null,8,["message"])]),s("div",M,[r.user.deleted_at?_("",!0):(d(),k(U,{key:0,disabled:l(a).processing},{default:c(()=>[p("Update ")]),_:1},8,["disabled"])),e(B,{onClick:h},{default:c(()=>[p(" Cancel ")]),_:1})])],32)])])])])]),_:1})],64))}};export{I as default};
