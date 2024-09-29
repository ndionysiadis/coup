const Ziggy = {"url":"http:\/\/coup.test","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"profile.edit":{"uri":"profile","methods":["GET","HEAD"]},"profile.update":{"uri":"profile","methods":["PATCH"]},"profile.destroy":{"uri":"profile","methods":["DELETE"]},"menu.index":{"uri":"menu","methods":["GET","HEAD"]},"menu.create":{"uri":"menu\/create","methods":["GET","HEAD"]},"menu.store":{"uri":"menu","methods":["POST"]},"menu.show":{"uri":"menu\/{menuType}","methods":["GET","HEAD"],"parameters":["menuType"],"bindings":{"menuType":"id"}},"menu.edit":{"uri":"menu\/{menuType}\/edit","methods":["GET","HEAD"],"parameters":["menuType"],"bindings":{"menuType":"id"}},"menu.update":{"uri":"menu\/{menuType}","methods":["PUT","PATCH"],"parameters":["menuType"],"bindings":{"menuType":"id"}},"menu.destroy":{"uri":"menu\/{menuType}","methods":["DELETE"],"parameters":["menuType"],"bindings":{"menuType":"id"}},"category.index":{"uri":"category","methods":["GET","HEAD"]},"category.create":{"uri":"category\/create","methods":["GET","HEAD"]},"category.store":{"uri":"category","methods":["POST"]},"category.show":{"uri":"category\/{category}","methods":["GET","HEAD"],"parameters":["category"],"bindings":{"category":"id"}},"category.edit":{"uri":"category\/{category}\/edit","methods":["GET","HEAD"],"parameters":["category"],"bindings":{"category":"id"}},"category.update":{"uri":"category\/{category}","methods":["PUT","PATCH"],"parameters":["category"],"bindings":{"category":"id"}},"category.destroy":{"uri":"category\/{category}","methods":["DELETE"],"parameters":["category"],"bindings":{"category":"id"}},"product.index":{"uri":"product","methods":["GET","HEAD"]},"product.create":{"uri":"product\/create","methods":["GET","HEAD"]},"product.store":{"uri":"product","methods":["POST"]},"product.show":{"uri":"product\/{product}","methods":["GET","HEAD"],"parameters":["product"],"bindings":{"product":"id"}},"product.edit":{"uri":"product\/{product}\/edit","methods":["GET","HEAD"],"parameters":["product"],"bindings":{"product":"id"}},"product.update":{"uri":"product\/{product}","methods":["PUT","PATCH"],"parameters":["product"],"bindings":{"product":"id"}},"product.destroy":{"uri":"product\/{product}","methods":["DELETE"],"parameters":["product"],"bindings":{"product":"id"}},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.store":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"password.update":{"uri":"password","methods":["PUT"]},"logout":{"uri":"logout","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
