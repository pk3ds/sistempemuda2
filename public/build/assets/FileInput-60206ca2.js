import{l,v as n,o as s,g as d}from"./app-70664ce5.js";const m=["value"],i={__name:"FileInput",props:["modelValue"],emits:["update:modelValue"],setup(u,{expose:t}){const e=l(null);return n(()=>{e.value.hasAttribute("autofocus")&&e.value.focus()}),t({focus:()=>e.value.focus()}),(r,o)=>(s(),d("input",{class:"text-gray-900 border-gray-300 focus:border-emerald-600 focus:ring-emerald-600 rounded-md shadow-sm rounded-lg cursor-pointer focus:outline-none border",value:u.modelValue,onInput:o[0]||(o[0]=a=>r.$emit("update:modelValue",a.target.value)),ref_key:"input",ref:e},null,40,m))}};export{i as _};