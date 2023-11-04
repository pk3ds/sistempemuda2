import{u as y,o as m,g as u,a as e,b as l,w as n,F as g,H as V,e as p,h,d as s,f as b,k,t as C,c as U,l as z}from"./app-38b1617d.js";import{_ as $}from"./AuthenticatedLayout-9eea7bbd.js";import{_ as c,a as f}from"./InputLabel-49de66af.js";import{_}from"./TextInput-acb2ecab.js";import{_ as H}from"./SelectInput-42dd388f.js";import{_ as B}from"./PrimaryButton-f21f69c8.js";import{_ as w}from"./SecondaryButton-61a960e3.js";import{A as q}from"./Accordion-eb4d0456.js";import"./ApplicationLogo-07bc528b.js";import"./_plugin-vue_export-helper-c27b6911.js";const E={key:0,class:"bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full",role:"alert"},M=s("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"exclamation-triangle",class:"w-4 h-4 mr-2 fill-current",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512"},[s("path",{fill:"currentColor",d:"M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"})],-1),N={class:"pt-8 pb-2"},j={class:"mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"},F={class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},L=s("span",{class:"font-semibold text-lg my-2"},"Edit User",-1),S={class:"flex justify-between"},A=s("span",null,[s("p",{class:"mt-1 text-sm text-gray-600"}," View or edit users for the event. ")],-1),O={key:0,class:"mt-1 text-gray-600"},P=s("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 448 512",width:"45",height:"45",fill:"currentColor"},[s("path",{d:"M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"})],-1),R=[P],T=["value"],D={class:"flex items-center gap-4"},se={__name:"Edit",props:{user:Object,roles:Object},setup(r){const d=r;function v(){window.history.back()}function x(){z.put(route("users.reset",d.user)).then(i=>{console.log(i.data)}).catch(i=>{console.log(i.response.status)})}const t=y({name:d.user.name,usernames:d.user.username,email:d.user.email,phone:d.user.phone,role_id:d.user.roles[0].id});return(i,o)=>(m(),u(g,null,[e(l(V),{title:"Edit User"}),e($,null,{default:n(()=>[r.user.deleted_at?(m(),u("div",E,[M,p(" This user has been deleted from the system, all records are for viewing only ")])):h("",!0),s("div",N,[s("div",j,[s("div",F,[e(q,null,{title:n(()=>[L]),content:n(()=>[s("section",null,[s("header",null,[s("div",S,[A,r.user.deleted_at?(m(),u("span",O,R)):h("",!0)])]),s("form",{onSubmit:o[5]||(o[5]=b(a=>l(t).patch(i.route("users.update",r.user)),["prevent"])),class:"mt-6 space-y-6"},[s("div",null,[e(c,{for:"name",value:"Name"}),e(_,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:l(t).name,"onUpdate:modelValue":o[0]||(o[0]=a=>l(t).name=a),required:"",readonly:r.user.deleted_at,autofocus:"",autocomplete:"name"},null,8,["modelValue","readonly"]),e(f,{class:"mt-2",message:l(t).errors.name},null,8,["message"])]),s("div",null,[e(c,{for:"usernames",value:"Username"}),e(_,{id:"usernames",type:"text",class:"mt-1 block w-full",modelValue:l(t).usernames,"onUpdate:modelValue":o[1]||(o[1]=a=>l(t).usernames=a),readonly:r.user.deleted_at,required:"",autocomplete:"usernames"},null,8,["modelValue","readonly"]),e(f,{class:"mt-2",message:l(t).errors.usernames},null,8,["message"])]),s("div",null,[e(c,{for:"email",value:"Email"}),e(_,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:l(t).email,"onUpdate:modelValue":o[2]||(o[2]=a=>l(t).email=a),readonly:r.user.deleted_at,required:"",autocomplete:"email"},null,8,["modelValue","readonly"]),e(f,{class:"mt-2",message:l(t).errors.email},null,8,["message"])]),s("div",null,[e(c,{for:"phone",value:"Phone"}),e(_,{id:"phone",type:"text",class:"mt-1 block w-full",modelValue:l(t).phone,"onUpdate:modelValue":o[3]||(o[3]=a=>l(t).phone=a),readonly:r.user.deleted_at,autocomplete:"phone",required:""},null,8,["modelValue","readonly"]),e(f,{class:"mt-2",message:l(t).errors.phone},null,8,["message"])]),s("div",null,[e(c,{for:"role_id",value:"Role"}),e(H,{id:"role_id",class:"mt-1 block w-full",modelValue:l(t).role_id,"onUpdate:modelValue":o[4]||(o[4]=a=>l(t).role_id=a),required:"",disabled:r.user.deleted_at},{default:n(()=>[(m(!0),u(g,null,k(r.roles,a=>(m(),u("option",{value:a.id},C(a.name),9,T))),256))]),_:1},8,["modelValue","disabled"]),e(f,{class:"mt-2",message:l(t).errors.role_id},null,8,["message"])]),s("div",D,[r.user.deleted_at?h("",!0):(m(),U(B,{key:0,disabled:l(t).processing},{default:n(()=>[p("Update ")]),_:1},8,["disabled"])),e(w,{onClick:x},{default:n(()=>[p(" Reset Password ")]),_:1}),e(w,{onClick:v},{default:n(()=>[p(" Cancel ")]),_:1})])],32)])]),_:1})])])])]),_:1})],64))}};export{se as default};
