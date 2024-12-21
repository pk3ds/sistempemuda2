import{A as S}from"./ApplicationLogo-90ba1c1f.js";import{v as N,D as E,j as x,l as A,o as a,g as l,d as t,G as k,B as D,E as z,a as o,w as s,n as m,b as g,T as j,c as p,L,e as r,F as B,h as n,t as y}from"./app-70664ce5.js";const R={class:"relative"},M={__name:"Dropdown",props:{align:{default:"right"},width:{default:"48"},contentClasses:{default:()=>["py-1","bg-white"]}},setup(c){const i=c,e=v=>{d.value&&v.key==="Escape"&&(d.value=!1)};N(()=>document.addEventListener("keydown",e)),E(()=>document.removeEventListener("keydown",e));const f=x(()=>({48:"w-48"})[i.width.toString()]),b=x(()=>i.align==="left"?"origin-top-left left-0":i.align==="right"?"origin-top-right right-0":"origin-top"),d=A(!1);return(v,h)=>(a(),l("div",R,[t("div",{onClick:h[0]||(h[0]=_=>d.value=!d.value)},[k(v.$slots,"trigger")]),D(t("div",{class:"fixed inset-0 z-40",onClick:h[1]||(h[1]=_=>d.value=!1)},null,512),[[z,d.value]]),o(j,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:s(()=>[D(t("div",{class:m(["absolute z-50 mt-2 rounded-md shadow-lg",[g(f),g(b)]]),style:{display:"none"},onClick:h[2]||(h[2]=_=>d.value=!1)},[t("div",{class:m(["rounded-md ring-1 ring-black ring-opacity-5",c.contentClasses])},[k(v.$slots,"content")],2)],2),[[z,d.value]])]),_:3})]))}},w={__name:"DropdownLink",setup(c){return(i,e)=>(a(),p(g(L),{class:"block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},{default:s(()=>[k(i.$slots,"default")]),_:3}))}},$={__name:"NavLink",props:["href","active"],setup(c){const i=c,e=x(()=>i.active?"inline-flex items-center px-1 pt-1 border-b-4 border-white-400 text-sm font-medium leading-5 text-white focus:outline-none focus:border-white transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out");return(f,b)=>(a(),p(g(L),{href:c.href,class:m(g(e))},{default:s(()=>[k(f.$slots,"default")]),_:3},8,["href","class"]))}},u={__name:"ResponsiveNavLink",props:["href","active"],setup(c){const i=c,e=x(()=>i.active?"block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-gray-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-300 hover:text-indigo-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-indigo-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out");return(f,b)=>(a(),p(g(L),{href:c.href,class:m(g(e))},{default:s(()=>[k(f.$slots,"default")]),_:3},8,["href","class"]))}},V={class:"min-h-screen bg-blue-200"},T={class:"bg-white border-b border-gray-100",style:{"background-image":"url('/assets/images/banner.png')","background-size":"cover"}},U={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},F={class:"flex justify-between h-16"},G={class:"flex"},P={class:"shrink-0 flex items-center"},W={key:0,class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},H={key:1,class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},O={key:2,class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},q={key:0,class:"hidden sm:flex sm:items-center sm:ml-6"},I={class:"ml-3 relative"},J={class:"inline-flex rounded-md"},K={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"},Q=t("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[t("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1),X={key:1,class:"hidden sm:flex sm:items-center sm:ml-6"},Y={class:"ml-3 relative"},Z=t("span",{class:"inline-flex rounded-md"},[t("button",{type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"},[r(" Guest "),t("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[t("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})])])],-1),ee={class:"-mr-2 flex items-center sm:hidden"},te={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},se={key:0,class:"pt-2 pb-3 space-y-1"},re={class:"pt-4 pb-1 border-t border-gray-200"},ae={class:"px-4"},oe={class:"font-medium text-base text-white"},ne={class:"font-medium text-sm text-gray-300"},ie={class:"mt-3 space-y-1"},le={class:"pt-4 pb-1 border-t border-gray-200"},ue={class:"pt-4 pb-1 border-t border-gray-200"},de={class:"space-y-1"},ce={key:0,class:"bg-green-100 rounded-b-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full",role:"alert"},he=t("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"check-circle",class:"w-4 h-4 mr-2 fill-current",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},[t("path",{fill:"currentColor",d:"M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"})],-1),pe={key:1,class:"bg-red-100 rounded-b-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full",role:"alert"},fe=t("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"times-circle",class:"w-4 h-4 mr-2 fill-current",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},[t("path",{fill:"currentColor",d:"M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"})],-1),me={key:2,class:"bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full",role:"alert"},ge=t("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"exclamation-triangle",class:"w-4 h-4 mr-2 fill-current",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512"},[t("path",{fill:"currentColor",d:"M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"})],-1),be={__name:"AuthenticatedLayout",setup(c){const i=A(!1);return(e,f)=>{var b,d,v,h,_;return a(),l("div",null,[t("div",V,[t("nav",T,[t("div",U,[t("div",F,[t("div",G,[t("div",P,[o(g(L),{href:"/"},{default:s(()=>[o(S,{class:"block h-9 w-auto fill-current text-white"})]),_:1})]),e.$page.props.auth.user?(a(),l("div",W,[o($,{href:e.route("dashboard"),active:e.route().current("dashboard")},{default:s(()=>[r(" Dashboard ")]),_:1},8,["href","active"]),((b=e.$page.props.auth.role)==null?void 0:b.name)==="Admin"?(a(),l(B,{key:0},[o($,{href:e.route("users"),active:e.route().current("users")},{default:s(()=>[r(" Users ")]),_:1},8,["href","active"]),o($,{href:e.route("sessions"),active:e.route().current("sessions")},{default:s(()=>[r(" Sessions ")]),_:1},8,["href","active"]),o($,{href:e.route("committees"),active:e.route().current("committees")},{default:s(()=>[r(" Committees ")]),_:1},8,["href","active"]),n("",!0)],64)):n("",!0),e.$page.props.auth.can["whatsapp.view"]||((d=e.$page.props.auth.role)==null?void 0:d.name)==="Admin"?(a(),p($,{key:1,href:e.route("whatsapp"),active:e.route().current("whatsapp")},{default:s(()=>[r(" Whatsapp Blasting ")]),_:1},8,["href","active"])):n("",!0)])):n("",!0),e.$page.props.auth.user&&!e.$page.props.auth.can["view navs"]?(a(),l("div",H)):n("",!0),e.$page.props.auth.user?n("",!0):(a(),l("div",O))]),e.$page.props.auth.user?(a(),l("div",q,[t("div",I,[o(M,{align:"right",width:"48"},{trigger:s(()=>[t("span",J,[t("button",K,[r(y(e.$page.props.auth.user.name)+" ",1),Q])])]),content:s(()=>{var C;return[e.$page.props.auth.can["view navs"]?n("",!0):(a(),p(w,{key:0,href:e.route("dashboard")},{default:s(()=>[r(" Dashboard ")]),_:1},8,["href"])),e.$page.props.auth.can["view navs"]?n("",!0):(a(),p(w,{key:1,href:e.route("draws.winners")},{default:s(()=>[r(" Lucky Draw ")]),_:1},8,["href"])),((C=e.$page.props.auth.role)==null?void 0:C.name)==="Admin"?(a(),p(w,{key:2,href:e.route("roles.index")},{default:s(()=>[r(" Roles And Permission ")]),_:1},8,["href"])):n("",!0),o(w,{href:e.route("logout"),method:"post",as:"button"},{default:s(()=>[r(" Logout ")]),_:1},8,["href"])]}),_:1})])])):n("",!0),e.$page.props.auth.user?n("",!0):(a(),l("div",X,[t("div",Y,[o(M,{align:"right",width:"48"},{trigger:s(()=>[Z]),content:s(()=>[o(w,{href:e.route("login")},{default:s(()=>[r(" Login ")]),_:1},8,["href"]),o(w,{href:e.route("register")},{default:s(()=>[r(" Register ")]),_:1},8,["href"]),o(w,{href:e.route("draws.winners")},{default:s(()=>[r(" Lucky Draw ")]),_:1},8,["href"])]),_:1})])])),t("div",ee,[t("button",{onClick:f[0]||(f[0]=C=>i.value=!i.value),class:"inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"},[(a(),l("svg",te,[t("path",{class:m({hidden:i.value,"inline-flex":!i.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),t("path",{class:m({hidden:!i.value,"inline-flex":i.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e.$page.props.auth.user?(a(),l("div",{key:0,class:m([{block:i.value,hidden:!i.value},"sm:hidden"])},[e.$page.props.auth.can["view navs"]?(a(),l("div",se,[o(u,{href:e.route("dashboard"),active:e.route().current("dashboard")},{default:s(()=>[r(" Dashboard ")]),_:1},8,["href","active"]),((v=e.$page.props.auth.role)==null?void 0:v.name)==="Admin"?(a(),l(B,{key:0},[o(u,{href:e.route("users"),active:e.route().current("users")},{default:s(()=>[r(" Users ")]),_:1},8,["href","active"]),o(u,{href:e.route("sessions"),active:e.route().current("sessions")},{default:s(()=>[r(" Sessions ")]),_:1},8,["href","active"]),o(u,{href:e.route("committees"),active:e.route().current("committees")},{default:s(()=>[r(" Committees ")]),_:1},8,["href","active"]),n("",!0)],64)):n("",!0),e.$page.props.auth.can["whatsapp.view"]||((h=e.$page.props.auth.role)==null?void 0:h.name)==="Admin"?(a(),p(u,{key:1,href:e.route("whatsapp"),active:e.route().current("whatsapp")},{default:s(()=>[r(" Whatsapp Blasting ")]),_:1},8,["href","active"])):n("",!0)])):n("",!0),t("div",re,[t("div",ae,[t("div",oe,y((_=e.$page.props.auth.user)==null?void 0:_.name),1),t("div",ne,y(e.$page.props.auth.user.email),1)]),t("div",ie,[e.$page.props.auth.can["view navs"]?n("",!0):(a(),p(u,{key:0,href:e.route("dashboard")},{default:s(()=>[r(" Dashboard ")]),_:1},8,["href"])),o(u,{href:e.route("draws.winners")},{default:s(()=>[r(" Lucky Draw ")]),_:1},8,["href"]),o(u,{href:e.route("profile.edit")},{default:s(()=>[r(" Profile ")]),_:1},8,["href"]),o(u,{href:e.route("logout"),method:"post",as:"button"},{default:s(()=>[r(" Logout ")]),_:1},8,["href"])])])],2)):n("",!0),e.$page.props.auth.user?n("",!0):(a(),l("div",{key:1,class:m([{block:i.value,hidden:!i.value},"sm:hidden"])},[t("div",le,[t("div",ue,[t("div",de,[o(u,{href:e.route("login")},{default:s(()=>[r(" Login ")]),_:1},8,["href"]),o(u,{href:e.route("register")},{default:s(()=>[r(" Register ")]),_:1},8,["href"]),o(u,{href:e.route("draws.winners")},{default:s(()=>[r(" Lucky Draw ")]),_:1},8,["href"])])])])],2))]),e.$page.props.flash.success?(a(),l("div",ce,[he,r(" "+y(e.$page.props.flash.success),1)])):n("",!0),e.$page.props.flash.error?(a(),l("div",pe,[fe,r(" "+y(e.$page.props.flash.error),1)])):n("",!0),e.$page.props.flash.warn?(a(),l("div",me,[ge,r(" "+y(e.$page.props.flash.warn),1)])):n("",!0),t("main",null,[k(e.$slots,"default")])])])}}};export{be as _};