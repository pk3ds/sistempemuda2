import{u,o as e,c as d,w as c,a as m,b as o,H as f,d as s,t as a,g as n,h as r,n as h,e as l,L as _,f as g}from"./app-d8e3cca8.js";import{_ as y}from"./GuestLayout-8bfc6fb2.js";import{_ as b}from"./PrimaryButton-a81a273a.js";import"./ApplicationLogo-17fb9362.js";import"./_plugin-vue_export-helper-c27b6911.js";const v=s("div",{class:"mb-4 text-lg font-bold text-gray-600"},"Activate",-1),w={class:"mb-4 flex items-start"},x=s("div",{class:"shrink-0"},[s("div",{class:"ml-2 mt-2 p-4 bg-blue-600 rounded-md shadow-md w-14 h-14 flex items-center justify-center"},[s("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512",fill:"white"},[s("path",{d:"M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm96-96c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zm128-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z"})])])],-1),H={class:"grow ml-6"},k={class:"font-bold mb-1"},$={class:"text-gray-500"},z={class:"text-gray-500"},V={key:0,class:"mb-4 text-sm text-gray-600"},B={key:1,class:"mb-4 text-sm text-gray-600"},C=["onSubmit"],N={class:"mt-4 flex items-center justify-between"},S={key:1},A={class:"text-sm text-gray-600 rounded-md"},O={__name:"Create",setup(L){const i=u(),p=()=>{i.post(route("profile.store"))};return(t,j)=>(e(),d(y,null,{default:c(()=>[m(o(f),{title:"Activate"}),v,s("div",w,[x,s("div",H,[s("p",k,a(t.$page.props.auth.user.name),1),s("p",$,a(t.$page.props.auth.user.email),1),s("p",z,a(t.$page.props.auth.user.staff_id),1)])]),t.$page.props.flash.status?r("",!0):(e(),n("div",V," Hi there! Seems like this is your first time here. Ready to start? If there is anything wrong, we will gladly fix it for you. ")),t.$page.props.flash.status?(e(),n("div",B,a(t.$page.props.flash.status),1)):r("",!0),s("form",{onSubmit:g(p,["prevent"])},[s("div",N,[t.$page.props.flash.status?r("",!0):(e(),d(b,{key:0,class:h({"opacity-25":o(i).processing}),disabled:o(i).processing},{default:c(()=>[l(" Activate ")]),_:1},8,["class","disabled"])),t.$page.props.flash.status?(e(),n("span",S)):r("",!0),s("span",A,[l(" Not you? "),m(o(_),{href:t.route("logout"),method:"post",as:"button",class:"hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:c(()=>[l(" Log Out")]),_:1},8,["href"])])])],40,C)]),_:1}))}};export{O as default};
