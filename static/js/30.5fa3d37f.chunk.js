(window.webpackJsonp=window.webpackJsonp||[]).push([[30],{230:function(t,e,a){"use strict";a.r(e);var n=a(3),r=a(4),c=a(6),i=a(5),s=a(7),o=a(0),u=a.n(o),l=a(10),p=a.n(l),d=a(249),h=a(11),f=function(t){function e(){var t,a;Object(n.a)(this,e);for(var r=arguments.length,s=new Array(r),o=0;o<r;o++)s[o]=arguments[o];return(a=Object(c.a)(this,(t=Object(i.a)(e)).call.apply(t,[this].concat(s)))).state={redirect:null},a}return Object(s.a)(e,t),Object(r.a)(e,[{key:"componentDidMount",value:function(){var t=this,e=this.props.match.params.alias,a=h.n+"/"+e;p.a.post(a).then(function(e){var a=e.data.slug?"/stores/"+e.data.slug:"/";t.setState({redirect:a})}).catch(function(t){this.setState({redirect:"/"})})}},{key:"render",value:function(){var t=this.state.redirect;return t?u.a.createElement(d.a,{to:t}):u.a.createElement("div",null)}}]),e}(o.Component);e.default=f}}]);