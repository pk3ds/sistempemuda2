import{H as v,L as B,r as s,o as l,g as c,a as o,w as a,F as p,d as t,e as d,k as P,t as i,h as S}from"./app-b970b15f.js";import{_ as L}from"./AuthenticatedLayout-e15ecbad.js";import{S as V}from"./_defineProperty-86f44a1f.js";import{_ as C}from"./PrimaryButton-7b85e3b3.js";import{_ as A}from"./SecondaryButton-a1881ffe.js";import{_ as D}from"./DangerButton-20d3e580.js";import{P as N}from"./Pagination-4ad9edf3.js";import{t as F,p as H}from"./throttle-40f1e273.js";import{_ as j}from"./_plugin-vue_export-helper-c27b6911.js";import"./ApplicationLogo-e8e8efcd.js";const I={components:{Head:v,Link:B,AuthenticatedLayout:L,SearchFilter:V,PrimaryButton:C,SecondaryButton:A,DangerButton:D,Pagination:N},props:{filters:Object,groups:Object},data(){return{form:{search:this.filters.search}}},watch:{form:{deep:!0,handler:F(function(){this.$inertia.get(route("groups"),H(this.form),{preserveState:!0})},150)}},methods:{deleteItem(n){confirm('Are you sure you want to delete "'+n.name+'"?')&&this.$inertia.delete(route("groups.destroy",n.id))}}},$={class:"pt-8 pb-2"},O={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},E={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},R={class:"p-6 text-gray-900"},T={class:"lg:px-6 flex justify-between border-b pb-2"},U=t("h4",{class:"text-lg mt-2 mr-2"},"Contingents",-1),q={class:"flex flex-col"},z={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},G={class:"py-2 inline-block min-w-full sm:px-6 lg:px-8"},J={class:"overflow-hidden"},K={class:"min-w-full"},M=t("thead",{class:"bg-white border-b"},[t("tr",null,[t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Name "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Description "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Remark "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Players "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Points "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Action ")])],-1),Q={class:"bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"},W={class:"text-sm text-gray-900 font-light px-6 py-4"},X={class:"text-sm text-gray-900 font-light px-6 py-4"},Y={class:"text-sm text-gray-900 font-light px-6 py-4"},Z={class:"text-sm text-gray-900 font-light px-6 py-4"},tt={class:"text-sm text-gray-900 font-light px-6 py-4"},et={class:"text-sm text-gray-900 font-light px-6 py-4"},ot={key:0},st=t("td",{class:"px-6 py-4 border-t text-center",colspan:"6"}," No contingents found. ",-1),nt=[st];function at(n,_,r,rt,u,f){const h=s("Head"),x=s("SearchFilter"),m=s("Link"),g=s("PrimaryButton"),y=s("SecondaryButton"),b=s("DangerButton"),w=s("Pagination"),k=s("AuthenticatedLayout");return l(),c(p,null,[o(h,{title:"Contingents"}),o(k,{auth:n.$page.props.auth},{default:a(()=>[t("div",$,[t("div",O,[t("div",E,[t("div",R,[t("div",T,[U,o(x,{modelValue:u.form.search,"onUpdate:modelValue":_[0]||(_[0]=e=>u.form.search=e),class:"mr-4 w-full max-w-md"},null,8,["modelValue"]),o(g,null,{default:a(()=>[o(m,{href:n.route("groups.create")},{default:a(()=>[d("Add")]),_:1},8,["href"])]),_:1})]),t("div",q,[t("div",z,[t("div",G,[t("div",J,[t("table",K,[M,t("tbody",null,[(l(!0),c(p,null,P(r.groups.data,e=>(l(),c("tr",Q,[t("td",W,[o(m,{href:n.route("groups.edit",e)},{default:a(()=>[d(i(e.name),1)]),_:2},1032,["href"])]),t("td",X,i(e.description),1),t("td",Y,i(e.remark),1),t("td",Z,i(e.users_count),1),t("td",tt,i(e.points),1),t("td",et,[o(y,{class:"mx-1"},{default:a(()=>[o(m,{href:n.route("groups.edit",e)},{default:a(()=>[d("View")]),_:2},1032,["href"])]),_:2},1024),o(b,{class:"mx-1",onClick:it=>f.deleteItem(e)},{default:a(()=>[d(" Delete ")]),_:2},1032,["onClick"])])]))),256)),r.groups.data.length===0?(l(),c("tr",ot,nt)):S("",!0)])])]),o(w,{class:"mt-6",links:r.groups.links,from:r.groups.from,to:r.groups.to,total:r.groups.total},null,8,["links","from","to","total"])])])])])])])])]),_:1},8,["auth"])],64)}const gt=j(I,[["render",at]]);export{gt as default};
