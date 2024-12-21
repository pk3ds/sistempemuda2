import{u as x,o as r,g as d,a as e,b as l,w as m,F as c,H as b,d as t,f as w,k as f,t as u,e as g}from"./app-70664ce5.js";import{_ as y}from"./AuthenticatedLayout-7218084b.js";import{_ as n,a as i}from"./InputLabel-0e70ad70.js";import{_ as p}from"./TextInput-0f70c7d0.js";import{_ as v}from"./SelectInput-3cf6fe57.js";import{_ as C}from"./PrimaryButton-d956092d.js";import{_ as $}from"./SecondaryButton-96e240d5.js";import"./ApplicationLogo-90ba1c1f.js";import"./_plugin-vue_export-helper-c27b6911.js";const h={class:"pt-8 pb-2"},U={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"},N={class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},q=t("header",null,[t("h2",{class:"text-lg font-medium text-gray-900"},"Add Contingent"),t("p",{class:"mt-1 text-sm text-gray-600"}," Create new contingents for the event. ")],-1),B=["value"],F=["value"],L={class:"flex items-center gap-4"},T={__name:"Create",props:{leaders:Object},setup(_){function k(){window.history.back()}const s=x({leader_id:"",coleader_id:"",name:"",description:"",remark:""});return(V,o)=>(r(),d(c,null,[e(l(b),{title:"Add Contingent"}),e(y,null,{default:m(()=>[t("div",h,[t("div",U,[t("div",N,[t("section",null,[q,t("form",{onSubmit:o[5]||(o[5]=w(a=>l(s).post(V.route("groups.store")),["prevent"])),class:"mt-6 space-y-6"},[t("div",null,[e(n,{for:"name",value:"Name"}),e(p,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:l(s).name,"onUpdate:modelValue":o[0]||(o[0]=a=>l(s).name=a),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.name},null,8,["message"])]),t("div",null,[e(n,{for:"leader_id",value:"Leader"}),e(v,{id:"leader_id",class:"mt-1 block w-full",modelValue:l(s).leader_id,"onUpdate:modelValue":o[1]||(o[1]=a=>l(s).leader_id=a),required:""},{default:m(()=>[(r(!0),d(c,null,f(_.leaders,a=>(r(),d("option",{value:a.id},u(a.name)+" - "+u(a.phone),9,B))),256))]),_:1},8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.leader_id},null,8,["message"])]),t("div",null,[e(n,{for:"coleader_id",value:"Co Leader"}),e(v,{id:"coleader_id",class:"mt-1 block w-full",modelValue:l(s).coleader_id,"onUpdate:modelValue":o[2]||(o[2]=a=>l(s).coleader_id=a),required:""},{default:m(()=>[(r(!0),d(c,null,f(_.leaders,a=>(r(),d("option",{value:a.id},u(a.name)+" - "+u(a.phone),9,F))),256))]),_:1},8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.coleader_id},null,8,["message"])]),t("div",null,[e(n,{for:"description",value:"Description"}),e(p,{id:"description",type:"text",class:"mt-1 block w-full",modelValue:l(s).description,"onUpdate:modelValue":o[3]||(o[3]=a=>l(s).description=a),autocomplete:"description"},null,8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.description},null,8,["message"])]),t("div",null,[e(n,{for:"remark",value:"Remark"}),e(p,{id:"remark",type:"text",class:"mt-1 block w-full",modelValue:l(s).remark,"onUpdate:modelValue":o[4]||(o[4]=a=>l(s).remark=a),autocomplete:"remark"},null,8,["modelValue"]),e(i,{class:"mt-2",message:l(s).errors.remark},null,8,["message"])]),t("div",L,[e(C,{disabled:l(s).processing},{default:m(()=>[g("Create")]),_:1},8,["disabled"]),e($,{onClick:k},{default:m(()=>[g(" Cancel ")]),_:1})])],32)])])])])]),_:1})],64))}};export{T as default};