const Ziggy = {"url":"http:\/\/localhost:8000","port":8000,"defaults":{},"routes":{"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"ad.index":{"uri":"api\/ad","methods":["GET","HEAD"]},"ad.store":{"uri":"api\/ad","methods":["POST"]},"ad.show":{"uri":"api\/ad\/{ad}","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
