import{l as s,v as r,o as n,g as d}from"./app-d499e920.js";const m=["value"],c={__name:"TextInput",props:["modelValue"],emits:["update:modelValue"],setup(o,{expose:t}){const e=s(null);return r(()=>{e.value.hasAttribute("autofocus")&&e.value.focus()}),t({focus:()=>e.value.focus()}),(a,u)=>(n(),d("input",{class:"border-gray-300 focus:border-emerald-600 focus:ring-emerald-600 rounded-md shadow-sm",value:o.modelValue,onInput:u[0]||(u[0]=l=>a.$emit("update:modelValue",l.target.value)),ref_key:"input",ref:e},null,40,m))}};export{c as _};