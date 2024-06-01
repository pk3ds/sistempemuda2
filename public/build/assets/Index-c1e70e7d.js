import{H as w,L as v,r as n,o as i,g as c,a as o,w as a,F as h,d as t,e as r,k,t as l,c as B,h as x}from"./app-ccc85bb8.js";import{_ as C}from"./AuthenticatedLayout-4c9d4514.js";import{_ as L}from"./PrimaryButton-d52410c7.js";import{_ as D}from"./SecondaryButton-c55488da.js";import{P as N}from"./Pagination-91d6053e.js";import{_ as P}from"./_plugin-vue_export-helper-c27b6911.js";import"./ApplicationLogo-5ce5b8a9.js";const S={components:{Head:w,Link:v,AuthenticatedLayout:C,PrimaryButton:L,SecondaryButton:D,Pagination:N},props:{winners:Object},data(){return{}},methods:{formatDate(e){return new Intl.DateTimeFormat("en-my",{dateStyle:"medium",timeStyle:"short",timeZone:"Asia/Kuala_Lumpur",hour12:!1}).format(new Date(e))},getClaimDate(e,m){return e?this.formatDate(m):"Not available"},claim(e){this.$inertia.put(route("winners.claim",e))}}},$={class:"pt-8 pb-2"},A={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},V={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},H={class:"p-6 text-gray-900"},F={class:"lg:px-6 flex justify-between border-b pb-2"},W=t("h4",{class:"text-lg mt-2 mr-2"},"Winners",-1),j={class:"flex flex-col"},z={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},I={class:"py-2 inline-block min-w-full sm:px-6 lg:px-8"},T={class:"overflow-hidden"},E={class:"min-w-full"},K=t("thead",{class:"bg-white border-b"},[t("tr",null,[t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," # "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Name "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Prize "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Status "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Claim Date "),t("th",{scope:"col",class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Action ")])],-1),O={class:"bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"},Z={class:"text-sm text-gray-900 font-light px-6 py-4"},q={class:"text-sm text-gray-900 font-light px-6 py-4"},G={class:"text-sm text-gray-900 font-light px-6 py-4"},J={class:"text-sm text-gray-900 font-light px-6 py-4"},M={class:"text-sm text-gray-900 font-light px-6 py-4"},Q={class:"text-sm text-gray-900 font-light px-6 py-4"},R={key:0},U=t("td",{class:"px-6 py-4 border-t text-center",colspan:"5"}," No winners found. ",-1),X=[U];function Y(e,m,_,tt,et,p){const f=n("Head"),d=n("Link"),u=n("PrimaryButton"),y=n("SecondaryButton"),g=n("AuthenticatedLayout");return i(),c(h,null,[o(f,{title:"Winners"}),o(g,{auth:e.$page.props.auth},{default:a(()=>[t("div",$,[t("div",A,[t("div",V,[t("div",H,[t("div",F,[W,o(u,null,{default:a(()=>[o(d,{href:e.route("draws.winners")},{default:a(()=>[r("Winners Page")]),_:1},8,["href"])]),_:1})]),t("div",j,[t("div",z,[t("div",I,[t("div",T,[t("table",E,[K,t("tbody",null,[(i(!0),c(h,null,k(_.winners,(s,b)=>(i(),c("tr",O,[t("td",Z,l(b+1),1),t("td",q,[o(d,{href:e.route("winners.edit",s)},{default:a(()=>[r(l(s.user.name),1)]),_:2},1032,["href"])]),t("td",G,l(s.prize),1),t("td",J,l(s.is_claimed?"Claimed":"Not claimed"),1),t("td",M,l(p.getClaimDate(s.is_claimed,s.claimed_at)),1),t("td",Q,[o(y,{class:"mx-1"},{default:a(()=>[o(d,{href:e.route("winners.edit",s)},{default:a(()=>[r("View")]),_:2},1032,["href"])]),_:2},1024),s.is_claimed?x("",!0):(i(),B(u,{key:0,class:"mx-1",onClick:st=>p.claim(s.id)},{default:a(()=>[r(" Claim ")]),_:2},1032,["onClick"]))])]))),256)),_.winners.length===0?(i(),c("tr",R,X)):x("",!0)])])])])])])])])])])]),_:1},8,["auth"])],64)}const dt=P(S,[["render",Y]]);export{dt as default};
