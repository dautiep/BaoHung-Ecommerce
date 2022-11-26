  <script src="{{ asset('chatbot/js/plugins.min.js') }}"></script>
  <script src="{{ asset('chatbot/js/main.min.js') }}"></script>
  <script src="{{ asset('chatbot/js/toastify-js.js') }}"></script>

  <script>
      LazyLoad = function(doc) {
          var env, head, pending = {},
              pollCount = 0,
              queue = {
                  css: [],
                  js: []
              },
              styleSheets = doc.styleSheets;

          function createNode(name, attrs) {
              var node = doc.createElement(name),
                  attr;
              for (attr in attrs) attrs.hasOwnProperty(attr) && node.setAttribute(attr, attrs[attr]);
              return node
          }

          function finish(type) {
              var p = pending[type],
                  callback, urls;
              p && (callback = p.callback, (urls = p.urls).shift(), pollCount = 0, urls.length || (callback &&
                  callback.call(p.context, p.obj), pending[type] = null, queue[type].length && load(type)))
          }

          function getEnv() {
              var ua = navigator.userAgent;
              ((env = {
                  async: !0 === doc.createElement("script").async
              }).webkit = /AppleWebKit\//.test(ua)) || (env.ie = /MSIE|Trident/.test(ua)) || (env.opera = /Opera/
                  .test(ua)) || (env.gecko = /Gecko\//.test(ua)) || (env.unknown = !0)
          }

          function load(type, urls, callback, obj, context) {
              var _finish = function() {
                      finish(type)
                  },
                  isCSS = "css" === type,
                  nodes = [],
                  i, len, node, p, pendingUrls, url;
              if (env || getEnv(), urls)
                  if (urls = "string" == typeof urls ? [urls] : urls.concat(), isCSS || env.async || env.gecko || env
                      .opera) queue[type].push({
                      urls: urls,
                      callback: callback,
                      obj: obj,
                      context: context
                  });
                  else
                      for (i = 0, len = urls.length; i < len; ++i) queue[type].push({
                          urls: [urls[i]],
                          callback: i === len - 1 ? callback : null,
                          obj: obj,
                          context: context
                      });
              if (!pending[type] && (p = pending[type] = queue[type].shift())) {
                  for (head || (head = doc.head || doc.getElementsByTagName("head")[0]), i = 0, len = (pendingUrls = p
                          .urls.concat()).length; i < len; ++i) url = pendingUrls[i], isCSS ? node = env.gecko ?
                      createNode("style") : createNode("link", {
                          href: url,
                          rel: "stylesheet"
                      }) : (node = createNode("script", {
                          src: url
                      })).async = !1, node.className = "lazyload", node.setAttribute("charset", "utf-8"), env.ie && !
                      isCSS && "onreadystatechange" in node && !("draggable" in node) ? node.onreadystatechange =
                      function() {
                          /loaded|complete/.test(node.readyState) && (node.onreadystatechange = null, _finish())
                      } : isCSS && (env.gecko || env.webkit) ? env.webkit ? (p.urls[i] = node.href, pollWebKit()) : (
                          node.innerHTML = '@import "' + url + '";', pollGecko(node)) : node.onload = node.onerror =
                      _finish, nodes.push(node);
                  for (i = 0, len = nodes.length; i < len; ++i) head.appendChild(nodes[i])
              }
          }

          function pollGecko(node) {
              var hasRules;
              try {
                  hasRules = !!node.sheet.cssRules
              } catch (ex) {
                  return void((pollCount += 1) < 200 ? setTimeout((function() {
                      pollGecko(node)
                  }), 50) : hasRules && finish("css"))
              }
              finish("css")
          }

          function pollWebKit() {
              var css = pending.css,
                  i;
              if (css) {
                  for (i = styleSheets.length; --i >= 0;)
                      if (styleSheets[i].href === css.urls[0]) {
                          finish("css");
                          break
                      } pollCount += 1, css && (pollCount < 200 ? setTimeout(pollWebKit, 50) : finish("css"))
              }
          }
          return {
              css: function(urls, callback, obj, context) {
                  load("css", urls, callback, obj, context)
              },
              js: function(urls, callback, obj, context) {
                  load("js", urls, callback, obj, context)
              }
          }
      }(this.document);


      LazyLoad.css([
          "{{ asset('chatbot/css/plugins.min.css') }}",
          'https://fonts.googleapis.com/icon?family=Material+Icons',
          'https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css',
          'https://fonts.googleapis.com/css2?family=KoHo:wght@200;300;400;500;600;700&display=swap',
          'https://cdn.jsdelivr.net/npm/@mdi/font@5.8.55/css/materialdesignicons.min.css',
          "https://fonts.googleapis.com/css2?family=Material+Icons",
          //- 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
          "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css",
          'https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css'
      ], function() {});
  </script>
