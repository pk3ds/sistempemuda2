import{L as c,r as d,o as n,g as o,d as a,F as l,k as m,c as u,n as _,t as r,h as f}from"./app-ccc85bb8.js";import{_ as g}from"./_plugin-vue_export-helper-c27b6911.js";const b={components:{Link:c},props:{links:Array,from:Number,to:Number,total:Number}},x={key:0,class:"flex justify-between"},p={class:"flex flex-wrap -mb-1"},h=["innerHTML"],k={class:"pt-4 text-gray-400 text-sm"};function y(L,v,e,N,B,H){const i=d("Link");return e.links.length>3?(n(),o("div",x,[a("div",p,[(n(!0),o(l,null,m(e.links,(t,s)=>(n(),o(l,null,[t.url===null?(n(),o("div",{key:s,class:"mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded-md",innerHTML:t.label},null,8,h)):(n(),u(i,{key:`link-${s}`,class:_(["mb-1 mr-1 px-4 py-3 text-sm leading-4 hover:bg-indigo-300 border focus:border-indigo-500 rounded-md",{"bg-indigo-200":t.active}]),href:t.url,innerHTML:t.label},null,8,["class","href","innerHTML"]))],64))),256))]),a("p",k,"Showing "+r(e.from)+" to "+r(e.to)+" of "+r(e.total),1)])):f("",!0)}const w=g(b,[["render",y]]);export{w as P};
