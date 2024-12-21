import{l as V,v as R,o as d,g as c,a4 as j,a5 as K,d as s,j as M,G as F,t as I,b as a,F as B,k as P,h as g,Y as S,u as O,a2 as U,a as o,w,H as z,f as G,B as X,E as Y,e as E,c as J}from"./app-70664ce5.js";import{_ as Q}from"./AuthenticatedLayout-7218084b.js";import{_ as h,a as b}from"./InputLabel-0e70ad70.js";import{_ as L}from"./SelectInput-3cf6fe57.js";import{_ as Z}from"./TextInput-0f70c7d0.js";import{_ as ee}from"./PrimaryButton-d956092d.js";import{_ as te}from"./SecondaryButton-96e240d5.js";/* empty css             */import{_ as ae}from"./FileInput-60206ca2.js";import{_ as T}from"./_plugin-vue_export-helper-c27b6911.js";import"./ApplicationLogo-90ba1c1f.js";const se=["value"],q={__name:"TextArea",props:["modelValue"],emits:["update:modelValue"],setup(u,{expose:f}){const i=V(null);return R(()=>{i.value.hasAttribute("autofocus")&&i.value.focus()}),f({focus:()=>i.value.focus()}),(_,v)=>(d(),c("textarea",{class:"border-gray-300 focus:border-emerald-600 focus:ring-emerald-600 rounded-md shadow-sm",value:u.modelValue,onInput:v[0]||(v[0]=t=>_.$emit("update:modelValue",t.target.value)),ref_key:"input",ref:i},null,40,se))}};const le={},W=u=>(j("data-v-ffe86f87"),u=u(),K(),u),oe={class:"half-circle-spinner"},ne=W(()=>s("div",{class:"circle circle-1"},null,-1)),re=W(()=>s("div",{class:"circle circle-2"},null,-1)),ie=[ne,re];function ue(u,f){return d(),c("div",oe,ie)}const de=T(le,[["render",ue],["__scopeId","data-v-ffe86f87"]]);const ce=u=>(j("data-v-97d0e722"),u=u(),K(),u),pe={class:"flex justify-between items-center"},me={class:"flex items-center gap-2"},_e={class:"text-sm text-gray-500"},fe=ce(()=>s("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-5 h-5"},[s("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"})],-1)),ge=[fe],ve=["onKeydown"],he={class:"flex flex-wrap gap-2 p-2"},be=["onClick"],ye={key:0,class:"bg-gray-100 border border-gray-200 text-gray-700 rounded-md px-2 py-1 text-sm flex items-center gap-1"},we=["placeholder","onKeydown"],xe={__name:"TagsInput",props:{modelValue:{type:String,default:""},placeholder:{type:String,default:"Enter numbers"}},emits:["update:modelValue"],setup(u,{emit:f}){const i=u,_=V(null),v=50,t=M(()=>{const e=i.modelValue.split(",").filter(n=>n);return{visible:e.slice(0,v),remaining:Math.max(0,e.length-v)}}),C=M(()=>i.modelValue.split(",").filter(e=>e).length);function k(e){e.preventDefault();const n=e.clipboardData.getData("text"),r=i.modelValue?i.modelValue+",":"";m(r+n),_.value&&(_.value.value="")}function D(e){if(e.ctrlKey&&e.key==="a"){e.preventDefault();const n=e.target.parentElement.parentElement,r=window.getSelection(),A=document.createRange();A.selectNodeContents(n),r.removeAllRanges(),r.addRange(A)}if(e.key==="Enter"&&e.target.value){e.preventDefault();const n=i.modelValue?i.modelValue+",":"";m(n+e.target.value),e.target.value=""}}function m(e){let n=typeof e=="object"?e.target.value:e;n=n.split(/[,\n]/).map(r=>r.trim()).filter(Boolean),n=n.map(r=>(r=r.replace(/\D/g,""),r.startsWith("60")?r:r.startsWith("1")?"60"+r:r.startsWith("0")?"6"+r:r)),n=[...new Set(n)],f("update:modelValue",n.join(","))}function p(e){const n=i.modelValue.split(",").filter(Boolean);f("update:modelValue",n.filter(r=>r!==e).join(","))}function y(e){e.target===e.currentTarget&&window.getSelection().toString().length>0&&(e.preventDefault(),f("update:modelValue",""),_.value&&(_.value.value=""))}function l(e){window.getSelection().toString().length>0&&(e.preventDefault(),f("update:modelValue",""),_.value&&(_.value.value=""))}function $(e){const n=i.modelValue.split(",").filter(Boolean);e.target.value===""&&n.length>0&&(e.preventDefault(),n.pop(),f("update:modelValue",n.join(",")))}function x(){f("update:modelValue",""),_.value&&(_.value.value="")}function H(e){if(e.target.value){const n=i.modelValue?i.modelValue+",":"";m(n+e.target.value),e.target.value=""}}return(e,n)=>(d(),c(B,null,[s("div",pe,[s("div",me,[F(e.$slots,"label",{},void 0,!0),s("span",_e,"("+I(a(C))+")",1)]),s("button",{type:"button",onClick:x,class:"text-gray-500 hover:text-red-600 transition-colors",title:"Clear all numbers"},ge)]),s("div",{class:"mt-1 block w-full border border-gray-300 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-600 rounded-md shadow-sm user-select-all bg-white",onKeydown:[S(y,["backspace"]),S(l,["delete"])],tabindex:"0"},[s("div",he,[(d(!0),c(B,null,P(a(t).visible,r=>(d(),c("div",{key:r,class:"bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-md px-2 py-1 text-sm flex items-center gap-1"},[s("span",null,I(r),1),s("button",{type:"button",onClick:A=>p(r),class:"text-emerald-500 hover:text-emerald-700 font-bold"}," × ",8,be)]))),128)),a(t).remaining>0?(d(),c("div",ye,[s("span",null,"+"+I(a(t).remaining)+" more",1),s("button",{type:"button",onClick:x,class:"text-gray-500 hover:text-red-600 ml-1",title:"Clear all numbers"}," × ")])):g("",!0),s("input",{type:"text",class:"flex-1 outline-none border-none focus:ring-0 min-w-[150px] text-sm text-gray-900 placeholder:text-gray-400",placeholder:u.placeholder,onKeydown:[D,S($,["backspace"]),S(l,["delete"])],onPaste:k,onBlur:H,ref_key:"numberInput",ref:_},null,40,we)])],40,ve)],64))}},Ve=T(xe,[["__scopeId","data-v-97d0e722"]]);const N=u=>(j("data-v-3a3a43b7"),u=u(),K(),u),ke={class:"pt-8 pb-2"},$e={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"},Se={class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},Ie=N(()=>s("header",null,[s("h2",{class:"text-lg font-medium text-gray-900"}," Whatsapp Blasting "),s("p",{class:"mt-1 text-sm text-gray-600"},"Send whatsapp")],-1)),Be=["onSubmit"],Ne=N(()=>s("option",{value:""},"Select a number",-1)),Ce=["value","disabled"],De={key:0},Ae={key:0},Ee=N(()=>s("option",{value:"message"},"Message",-1)),Me=N(()=>s("option",{value:"photo"},"Photo",-1)),je={key:1},Ke={key:2},Te={key:0,class:"pt-5"},Ue={key:1,class:"pt-5"},Le={class:"flex items-center gap-4"},qe={key:0},Pe={key:1},We={__name:"Index",props:{whatsappNumber:{type:Array,required:!0}},setup(u){const f=u,i=V(!1);V(null),M(()=>U().props.value.flash).value;function _(){window.history.back()}function v(m){m.target.files&&(t.file_upload=m.target.files[0])}const t=O({message:"",option:"",file_upload:[],caption:"",view_once:!1,compress:!0,number:"",array_number:""}),C=async()=>{try{i.value=!0,await t.post(route("whatsapp.store"),{onSuccess:()=>{i.value=!1,t.reset()}})}catch(m){console.error("Error:",m)}};V(null);const k=U();function D(m){const p=k.props.value.auth.role.name==="Admin",y=m.users.some(l=>l.id===k.props.value.auth.user.id);return p||y}return(m,p)=>(d(),c(B,null,[o(a(z),{title:"Whatsapp Blasting"}),o(Q,{auth:m.$page.props.auth},{default:w(()=>{var y;return[s("div",ke,[s("div",$e,[s("div",Se,[s("section",null,[Ie,s("form",{onSubmit:G(C,["prevent"]),enctype:"multipart/form-data",class:"mt-6 space-y-6",onChange:v},[s("div",null,[o(h,{for:"number",value:"Blasting Number"}),o(L,{id:"number",class:"mt-1 block w-full",modelValue:a(t).number,"onUpdate:modelValue":p[0]||(p[0]=l=>a(t).number=l),required:""},{default:w(()=>[Ne,(d(!0),c(B,null,P(f.whatsappNumber,l=>{var $,x;return X((d(),c("option",{key:l.id,value:l.id,disabled:($=l.first_whatsapp_batches)==null?void 0:$.isActive},[E(I(l.name)+" ",1),(x=l.first_whatsapp_batches)!=null&&x.isActive?(d(),c("span",De," - number blasting in progress ")):g("",!0)],8,Ce)),[[Y,D(l)]])}),128))]),_:1},8,["modelValue"]),o(b,{class:"mt-2",message:a(t).errors.name},null,8,["message"])]),a(t).number&&((y=f.whatsappNumber.find(l=>l.id==a(t).number))!=null&&y.canSendPersonal)?(d(),c("div",Ae,[o(Ve,{modelValue:a(t).array_number,"onUpdate:modelValue":p[1]||(p[1]=l=>a(t).array_number=l),placeholder:"Enter numbers"},{label:w(()=>[o(h,{for:"array_number",value:"Number"})]),_:1},8,["modelValue"]),o(b,{class:"mt-2",message:a(t).errors.array_number},null,8,["message"])])):g("",!0),s("div",null,[o(h,{for:"option",value:"Blasting Option"}),o(L,{id:"option",class:"mt-1 block w-full",modelValue:a(t).option,"onUpdate:modelValue":p[2]||(p[2]=l=>a(t).option=l),required:""},{default:w(()=>[Ee,Me]),_:1},8,["modelValue"]),o(b,{class:"mt-2",message:a(t).errors.name},null,8,["message"])]),a(t).option==="message"?(d(),c("div",je,[o(h,{for:"message",value:"Message"}),o(q,{id:"message",type:"text",class:"mt-1 block w-full",modelValue:a(t).message,"onUpdate:modelValue":p[3]||(p[3]=l=>a(t).message=l),required:""},null,8,["modelValue"]),o(b,{class:"mt-2",message:a(t).errors.message},null,8,["message"])])):g("",!0),["photo","video"].indexOf(a(t).option)>-1?(d(),c("div",Ke,[s("div",null,[o(h,{for:"message",value:"Message"}),o(q,{id:"message",type:"text",class:"mt-1 block w-full",modelValue:a(t).message,"onUpdate:modelValue":p[4]||(p[4]=l=>a(t).message=l),required:""},null,8,["modelValue"]),o(b,{class:"mt-2",message:a(t).errors.message},null,8,["message"])]),a(t).option==="photo"?(d(),c("div",Te,[o(h,{for:"file_upload",value:"Image"}),o(ae,{id:"file_upload",type:"file",class:"mt-1 block w-full",accept:"image/*"}),o(b,{class:"mt-2",file_upload:a(t).errors.file_upload},null,8,["file_upload"])])):g("",!0),a(t).option==="video"?(d(),c("div",Ue,[o(h,{for:"file_upload",value:"Video"}),o(Z,{id:"file_upload",type:"file",class:"mt-1 block w-full",modelValue:a(t).file_upload,"onUpdate:modelValue":p[5]||(p[5]=l=>a(t).file_upload=l),accept:"video/*"},null,8,["modelValue"]),o(b,{class:"mt-2",file_upload:a(t).errors.file_upload},null,8,["file_upload"])])):g("",!0)])):g("",!0),s("div",Le,[i.value?g("",!0):(d(),c("div",qe,[m.$page.props.auth.role.name==="Admin"||m.$page.props.auth.can["whatsapp.view"]?(d(),J(ee,{key:0,disabled:a(t).processing},{default:w(()=>[E(" Send ")]),_:1},8,["disabled"])):g("",!0)])),i.value?(d(),c("div",Pe,[o(de,{"animation-duration":1e3,size:30,color:"#17e083"})])):g("",!0),o(te,{onClick:_},{default:w(()=>[E(" Cancel ")]),_:1})])],40,Be)])])])])]}),_:1},8,["auth"])],64))}},et=T(We,[["__scopeId","data-v-3a3a43b7"]]);export{et as default};