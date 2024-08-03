import{H as k,L as S,r as a,o as i,g as l,a as s,w as n,F as h,d as t,e as c,k as B,t as m,h as D}from"./app-0f879bd6.js";import{_ as L}from"./AuthenticatedLayout-1dff01db.js";import{S as V}from"./_defineProperty-0bda1879.js";import{_ as A}from"./PrimaryButton-2486db8f.js";import{_ as P}from"./SecondaryButton-c6af0c1b.js";import{_ as F}from"./DangerButton-3cc53e4f.js";import{P as N}from"./Pagination-9ade29f3.js";import{t as C,p as I}from"./throttle-3a128c63.js";import{_ as H}from"./_plugin-vue_export-helper-c27b6911.js";import"./ApplicationLogo-429fb7ab.js";const j={components:{Head:k,Link:S,AuthenticatedLayout:L,SearchFilter:V,PrimaryButton:A,SecondaryButton:P,DangerButton:F,Pagination:N},props:{filters:Object,meetings:Object},data(){return{form:{search:this.filters.search}}},watch:{form:{deep:!0,handler:C(function(){this.$inertia.get(route("sessions"),I(this.form),{preserveState:!0})},150)}},methods:{deleteItem(e){confirm('Are you sure you want to delete "'+e.name+" ("+this.formatDate(e.start_at)+')"?')&&this.$inertia.delete(route("sessions.destroy",e.id))},formatDate(e){return new Intl.DateTimeFormat("en-my",{dateStyle:"medium",timeStyle:"short",timeZone:"Asia/Kuala_Lumpur",hour12:!1}).format(new Date(e))}}},E={class:"pt-8 pb-2"},O={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},T={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},U={class:"p-6 text-gray-900"},q={class:"lg:px-6 flex justify-between border-b pb-2"},K=t("h4",{class:"text-lg mt-2 mr-2"},"Sessions",-1),Z={class:"flex flex-col"},$={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},z={class:"py-2 inline-block min-w-full sm:px-6 lg:px-8"},G={class:"overflow-hidden"},J={class:"min-w-full"},M=t("thead",{class:"bg-white border-b"},[t("tr",null,[t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Name "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Unique ID "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Start "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," End "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Action ")])],-1),Q={class:"bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"},R={class:"text-sm text-gray-900 font-light px-6 py-4"},W={class:"text-sm text-gray-900 font-light px-6 py-4"},X={class:"text-sm text-gray-900 font-light px-6 py-4"},Y={class:"text-sm text-gray-900 font-light px-6 py-4"},tt={class:"text-sm text-gray-900 font-light px-6 py-4"},et={key:0},st=t("td",{class:"px-6 py-4 border-t text-center",colspan:"5"}," No sessions found. ",-1),ot=[st];function at(e,u,r,nt,f,d){const p=a("Head"),x=a("SearchFilter"),_=a("Link"),y=a("PrimaryButton"),g=a("SecondaryButton"),w=a("DangerButton"),b=a("Pagination"),v=a("AuthenticatedLayout");return i(),l(h,null,[s(p,{title:"Sessions"}),s(v,{auth:e.$page.props.auth},{default:n(()=>[t("div",E,[t("div",O,[t("div",T,[t("div",U,[t("div",q,[K,s(x,{modelValue:f.form.search,"onUpdate:modelValue":u[0]||(u[0]=o=>f.form.search=o),class:"mr-4 w-full max-w-md"},null,8,["modelValue"]),s(y,null,{default:n(()=>[s(_,{href:e.route("sessions.create")},{default:n(()=>[c("Add")]),_:1},8,["href"])]),_:1})]),t("div",Z,[t("div",$,[t("div",z,[t("div",G,[t("table",J,[M,t("tbody",null,[(i(!0),l(h,null,B(r.meetings.data,o=>(i(),l("tr",Q,[t("td",R,[s(_,{href:e.route("sessions.edit",o)},{default:n(()=>[c(m(o.name),1)]),_:2},1032,["href"])]),t("td",W,m(o.uuid),1),t("td",X,m(d.formatDate(o.start_at)),1),t("td",Y,m(d.formatDate(o.end_at)),1),t("td",tt,[s(g,{class:"mx-1"},{default:n(()=>[s(_,{href:e.route("sessions.edit",o)},{default:n(()=>[c("View")]),_:2},1032,["href"])]),_:2},1024),s(w,{class:"mx-1",onClick:rt=>d.deleteItem(o)},{default:n(()=>[c(" Delete ")]),_:2},1032,["onClick"])])]))),256)),r.meetings.data.length===0?(i(),l("tr",et,ot)):D("",!0)])])]),s(b,{class:"mt-6",links:r.meetings.links,from:r.meetings.from,to:r.meetings.to,total:r.meetings.total},null,8,["links","from","to","total"])])])])])])])])]),_:1},8,["auth"])],64)}const xt=H(j,[["render",at]]);export{xt as default};
