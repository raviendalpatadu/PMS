const electron = require('electron')
// Module to control application life.
const app = electron.app
// Module for mennu
const Menu = electron.Menu
// Module to create native browser window.
const BrowserWindow = electron.BrowserWindow

const path = require('path')
const url = require('url')

/////////////////////////////

///////////////////////////////
// Copy paste fixed by this 

app.on('ready', () => {
  //  createWindow() // commented for avoiding double window issue
  if (process.platform === 'darwin') {
    var template = [{
      label: 'FromScratch',
      submenu: [{
        label: 'Quit',
        accelerator: 'CmdOrCtrl+Q',
        click: function () { app.quit(); }
      }]
    }, {
      label: 'Edit',
      submenu: [{
        label: 'Undo',
        accelerator: 'CmdOrCtrl+Z',
        selector: 'undo:'
      }, {
        label: 'Redo',
        accelerator: 'Shift+CmdOrCtrl+Z',
        selector: 'redo:'
      }, {
        type: 'separator'
      }, {
        label: 'Cut',
        accelerator: 'CmdOrCtrl+X',
        selector: 'cut:'
      }, {
        label: 'Copy',
        accelerator: 'CmdOrCtrl+C',
        selector: 'copy:'
      }, {
        label: 'Paste',
        accelerator: 'CmdOrCtrl+V',
        selector: 'paste:'
      }, {
        label: 'Select All',
        accelerator: 'CmdOrCtrl+A',
        selector: 'selectAll:'
      }]
    }];
    var osxMenu = Menu.buildFromTemplate(template);
    Menu.setApplicationMenu(osxMenu);
  }
})

// PHP SERVER CREATION /////
const PHPServer = require('php-server-manager');

const server = new PHPServer({

  port: 3000,
  directory: __dirname,
  directives: {
    display_errors: 1,
    expose_php: 1
  }
});

//////////////////////////

// Keep a global reference of the window object, if you don't, the window will
// be closed automatically when the JavaScript object is garbage collected.
let mainWindow

function createWindow() {

  server.run();
  // Create the browser window.
  mainWindow = new BrowserWindow({
    icon: 'lib/img/icons/32/graph.png',
    webPreferences: {
      nodeIntegration: true
    },
    /// show to false mean than the window will proceed with its lifecycle, but will not render until we will show it up
    show: false,
    backgroundColor: '#2e363f',
    // titleBarStyle: 'hiddenInset'
  })
  // and load the index.html of the app.
  mainWindow.loadURL('http://' + server.host + ':' + server.port + '/')
  mainWindow.setMenuBarVisibility(false)
  mainWindow.maximize()

  /// keep listening on the did-finish-load event, when the mainWindow content has loaded
  mainWindow.webContents.on('did-finish-load', () => {
    /// then close the loading screen window and show the main window
    if (loadingScreen) {
      loadingScreen.close();
    }
    mainWindow.show();
  });

  // console.log(path.join(app.getAppPath(),"preload.js"));
  /*
  mainWindow.loadURL(url.format({
    pathname: path.join(__dirname, 'index.php'),
    protocol: 'file:',
    slashes: true
  }))
  */
  // mainWindow.on('ready-to-show', function () {
  //   mainWindow.show();
  // });
  const { shell } = require('electron')
  //  shell.showItemInFolder('fullPath')

  // Open the DevTools.
  // mainWindow.webContents.openDevTools()

  // Emitted when the window is closed.
  mainWindow.on('closed', function () {
    // Dereference the window object, usually you would store windows
    // in an array if your app supports multi windows, this is the time
    // when you should delete the corresponding element.
    // PHP SERVER QUIT
    server.close();
    mainWindow = null;
  })
}
// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Some APIs can only be used after this event occurs.

/// create a global var, wich will keep a reference to out loadingScreen window
let loadingScreen;
const createLoadingScreen = () => {
  /// create a browser window
  loadingScreen = new BrowserWindow(
    Object.assign({
      /// define width and height for the window
      width: 600,
      height: 400,
      icon: 'lib/img/icons/32/graph.png',
      /// remove the window frame, so it will become a frameless window
      frame: false,
      /// and set the transparency, to remove any window background color
      transparent: false
    })
  );
  loadingScreen.setResizable(false);
  loadingScreen.loadURL(
    'file://' + __dirname + '/loading.php'
  );
  loadingScreen.on('closed', () => (loadingScreen = null));
  loadingScreen.webContents.on('did-finish-load', () => {
    loadingScreen.show();
  });
};
app.on('ready', function () {
  createLoadingScreen();
  setTimeout(() => {
    createWindow();
  },2000 );
}) // <== this is extra so commented, enabling this can show 2 windows..

// Quit when all windows are closed.
app.on('window-all-closed', function () {
  // On OS X it is common for applications and their menu bar
  // to stay active until the user quits explicitly with Cmd + Q
  if (process.platform !== 'darwin') {
    // PHP SERVER QUIT
    server.close();
    app.quit();
  }
})

app.on('activate', function () {
  // On OS X it's common to re-create a window in the app when the
  // dock icon is clicked and there are no other windows open.
  if (mainWindow === null) {
    createWindow()
  }
})



// In this file you can include the rest of your app's specific main process
// code. You can also put them in separate files and require them here.
