(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[17],{127:function(e,t,o){"use strict";var n=o(5),l=o.n(n),c=o(0),r=o(14),a=o(4),i=o.n(a);o(155),t.a=e=>{let{className:t="",disabled:o=!1,name:n,permalink:a="",rel:s,style:u,onClick:d,...b}=e;const p=i()("wc-block-components-product-name",t);if(o){const e=b;return Object(c.createElement)("span",l()({className:p},e,{dangerouslySetInnerHTML:{__html:Object(r.decodeEntities)(n)}}))}return Object(c.createElement)("a",l()({className:p,href:a,rel:s},b,{dangerouslySetInnerHTML:{__html:Object(r.decodeEntities)(n)},style:u}))}},155:function(e,t){},245:function(e,t,o){"use strict";var n=o(77);let l={headingLevel:{type:"number",default:2},showProductLink:{type:"boolean",default:!0},productId:{type:"number",default:0}};Object(n.b)()&&(l={...l,align:{type:"string"},color:{type:"string"},customColor:{type:"string"},fontSize:{type:"string"},customFontSize:{type:"number"}}),t.a=l},246:function(e,t,o){"use strict";var n=o(0),l=o(4),c=o.n(l),r=o(29),a=o(7),i=o(77),s=o(54),u=o(127),d=o(60);o(297);const b=e=>{let{children:t,headingLevel:o,elementType:l="h"+o,...c}=e;return Object(n.createElement)(l,c,t)};t.a=Object(s.withProductDataContext)(e=>{var t,o,l,s;let{className:p,headingLevel:m=2,showProductLink:v=!0,align:f,textColor:j,fontSize:O,style:h}=e;const{parentClassName:y}=Object(r.useInnerBlockLayoutContext)(),{product:g}=Object(r.useProductDataContext)(),{dispatchStoreEvent:k}=Object(d.a)(),w=Object(a.getColorClassName)("color",j),S=Object(a.getFontSizeClass)(O),C=c()("wp-block-woocommerce-product-title",{"has-text-color":j||(null==h||null===(t=h.color)||void 0===t?void 0:t.text)||(null==h?void 0:h.color),"has-font-size":O||(null==h||null===(o=h.typography)||void 0===o?void 0:o.fontSize)||(null==h?void 0:h.fontSize),[w]:w,[S]:S}),z={fontSize:(null==h?void 0:h.fontSize)||(null==h||null===(l=h.typography)||void 0===l?void 0:l.fontSize),color:(null==h||null===(s=h.color)||void 0===s?void 0:s.text)||(null==h?void 0:h.color)};return g.id?Object(n.createElement)(b,{headingLevel:m,className:c()(p,"wc-block-components-product-title",{[y+"__product-title"]:y,["wc-block-components-product-title--align-"+f]:f&&Object(i.b)()})},Object(n.createElement)(u.a,{className:c()({[C]:Object(i.b)()}),disabled:!v,name:g.name,permalink:g.permalink,rel:v?"nofollow":"",onClick:()=>{k("product-view-link",{product:g})},style:Object(i.b)()?z:{}})):Object(n.createElement)(b,{headingLevel:m,className:c()(p,"wc-block-components-product-title",{[y+"__product-title"]:y,["wc-block-components-product-title--align-"+f]:f&&Object(i.b)(),[C]:Object(i.b)()})})})},297:function(e,t){},496:function(e,t,o){"use strict";o.r(t);var n=o(54),l=o(246),c=o(245);t.default=Object(n.withFilteredAttributes)(c.a)(l.a)}}]);