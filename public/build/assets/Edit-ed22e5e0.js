import{_ as b}from"./AuthenticatedLayout-4c9d4514.js";import{a as x,_ as v}from"./InputLabel-116ba9e7.js";import{_ as g}from"./TextInput-d83a2d42.js";import{_ as h}from"./SelectInput-39bf080d.js";import{_ as V}from"./PrimaryButton-d52410c7.js";import{_ as I}from"./SecondaryButton-c55488da.js";import{H as S,L as z,r as s,o as B,g as L,a as e,w as i,F as C,d as t,f as E,e as c}from"./app-ccc85bb8.js";import{_ as N}from"./_plugin-vue_export-helper-c27b6911.js";import"./ApplicationLogo-5ce5b8a9.js";const T={components:{Head:S,Link:z,AuthenticatedLayout:b,PrimaryButton:V,SecondaryButton:I,InputError:x,InputLabel:v,TextInput:g,SelectInput:h},props:{winner:Object},data(){return{form:this.$inertia.form({name:this.winner.user.name,prize:this.winner.prize,remark:this.winner.remark,is_claimed:this.winner.is_claimed})}},methods:{back(){window.history.back()},formatDate(u){return new Intl.DateTimeFormat("en-my",{dateStyle:"medium",timeStyle:"short",timeZone:"Asia/Kuala_Lumpur",hour12:!1}).format(new Date(u))}}},U={class:"pt-8 pb-2"},A={class:"mt-4 md:mt-0 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"},H={class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},P=t("header",null,[t("div",{class:"flex justify-between"},[t("span",null,[t("p",{class:"mt-1 text-sm text-gray-600"}," View or edit winners for lucky draw. ")])])],-1),D=t("option",{value:1},"Claimed",-1),F=t("option",{value:0},"Not claimed",-1),j={class:"flex items-center gap-4"};function q(u,n,a,K,o,p){const _=s("Head"),l=s("InputLabel"),d=s("TextInput"),m=s("InputError"),f=s("SelectInput"),w=s("PrimaryButton"),y=s("SecondaryButton"),k=s("AuthenticatedLayout");return B(),L(C,null,[e(_,{title:"Edit Winner"}),e(k,null,{default:i(()=>[t("div",U,[t("div",A,[t("div",H,[t("section",null,[P,t("form",{onSubmit:n[4]||(n[4]=E(r=>o.form.patch(u.route("winners.update",a.winner.id)),["prevent"])),class:"mt-6 space-y-6"},[t("div",null,[e(l,{for:"name",value:"Name"}),e(d,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:o.form.name,"onUpdate:modelValue":n[0]||(n[0]=r=>o.form.name=r),required:"",readonly:"",autocomplete:"name"},null,8,["modelValue"]),e(m,{class:"mt-2",message:o.form.errors.name},null,8,["message"])]),t("div",null,[e(l,{for:"prize",value:"Prize"}),e(d,{id:"prize",type:"text",class:"mt-1 block w-full",modelValue:o.form.prize,"onUpdate:modelValue":n[1]||(n[1]=r=>o.form.prize=r),autocomplete:"prize",readonly:a.winner.is_claimed},null,8,["modelValue","readonly"]),e(m,{class:"mt-2",message:o.form.errors.prize},null,8,["message"])]),t("div",null,[e(l,{for:"remark",value:"Remark"}),e(d,{id:"remark",type:"text",class:"mt-1 block w-full",modelValue:o.form.remark,"onUpdate:modelValue":n[2]||(n[2]=r=>o.form.remark=r),readonly:a.winner.is_claimed,autocomplete:"remark"},null,8,["modelValue","readonly"]),e(m,{class:"mt-2",message:o.form.errors.remark},null,8,["message"])]),t("div",null,[e(l,{for:"is_claimed",value:"Status"}),e(f,{id:"is_claimed",class:"mt-1 block w-full",modelValue:o.form.is_claimed,"onUpdate:modelValue":n[3]||(n[3]=r=>o.form.is_claimed=r),disabled:a.winner.is_claimed,required:""},{default:i(()=>[D,F]),_:1},8,["modelValue","disabled"]),e(m,{class:"mt-2",message:o.form.errors.is_claimed},null,8,["message"])]),t("div",j,[e(w,{disabled:o.form.processing},{default:i(()=>[c("Update ")]),_:1},8,["disabled"]),e(y,{onClick:p.back},{default:i(()=>[c(" Cancel ")]),_:1},8,["onClick"])])],32)])])])])]),_:1})],64)}const Y=N(T,[["render",q]]);export{Y as default};
