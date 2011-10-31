new Ext.KeyMap(document, [{
  key: Ext.EventObject.F5,
  fn: function(k, e) {
    if (!e.ctrlKey) {
      if (Ext.isIE) {
        e.browserEvent.keyCode = 8;
      }
      e.stopEvent();
      document.location = document.location;
    }
    else {
      Ext.Msg.alert('Refresh', 'You clicked: CTRL-F5');
    }
  }
},
{
  key: Ext.EventObject.DELETE,
  fn: function(k, e) {
    iGrid = Ext.getCmp('infoGrid');
    rowSelected = iGrid.getSelectionModel().getSelected();
    if (rowSelected) {
      deleteDashletInstance();
    }
  }
},
{
  key: Ext.EventObject.F2,
  fn: function(k, e) {
    iGrid = Ext.getCmp('infoGrid');
    rowSelected = iGrid.getSelectionModel().getSelected();
    if (rowSelected){
      editDashletInstance();
    }
  }
}
]);

var store;
var cmodel;
var infoGrid;
var viewport;
var smodel;
var newButton;
var editButton;
var deleteButton;
//var searchButton;
//var searchText;
//var clearTextButton;
var actionButtons;
var contextMenu;

Ext.onReady(function(){
  Ext.QuickTips.init();

  pageSize = 20; //parseInt(CONFIG.pageSize);

  newButton = new Ext.Action({
    text: _('ID_NEW'),
    iconCls: 'button_menu_ext ss_sprite ss_add',
    handler: newDashletInstance
  });

  editButton = new Ext.Action({
    text: _('ID_EDIT'),
    iconCls: 'button_menu_ext ss_sprite  ss_pencil',
    handler: editDashletInstance,
    disabled: true
  });

  deleteButton = new Ext.Action({
    text: _('ID_DELETE'),
    iconCls: 'button_menu_ext ss_sprite  ss_delete',
    handler: deleteDashletInstance,
    disabled: true
  });

  /*searchButton = new Ext.Action({
    text: _('ID_SEARCH'),
    handler: doSearch
  });

  searchText = new Ext.form.TextField ({
    id: 'searchText',
    ctCls:'pm_search_text_field',
    allowBlank: true,
    width: 150,
    emptyText: _('ID_ENTER_SEARCH_TERM'),
    listeners: {
      specialkey: function(f, e){
        if (e.getKey() == e.ENTER) {
          doSearch();
        }
      },
      focus: function(f, e) {
        var row = infoGrid.getSelectionModel().getSelected();
        infoGrid.getSelectionModel().deselectRow(infoGrid.getStore().indexOf(row));
      }
    }
  });

  clearTextButton = new Ext.Action({
    text: 'X',
    ctCls:'pm_search_x_button',
    handler: gridByDefault
  });*/

  contextMenu = new Ext.menu.Menu({
    items: [editButton, deleteButton]
  });

  actionButtons = [newButton, '-', editButton, deleteButton/*, {xtype: 'tbfill'}, searchText, clearTextButton, searchButton*/];

  smodel = new Ext.grid.RowSelectionModel({
    singleSelect: true,
    listeners:{
      rowselect: function(sm, index, record){
        editButton.enable();
        deleteButton.enable();
        if (typeof(_rowselect) !== 'undefined') {
          if (Ext.isArray(_rowselect)) {
            for (var i = 0; i < _rowselect.length; i++) {
              if (Ext.isFunction(_rowselect[i])) {
                _rowselect[i](sm, index, record);
              }
            }
          }
        }
      },
      rowdeselect: function(sm, index, record){
        editButton.disable();
        deleteButton.disable();
        if (typeof(_rowdeselect) !== 'undefined') {
          if (Ext.isArray(_rowdeselect)) {
            for (var i = 0; i < _rowdeselect.length; i++) {
              if (Ext.isFunction(_rowdeselect[i])) {
                _rowdeselect[i](sm, index, record);
              }
            }
          }
        }
      }
    }
  });

  store = new Ext.data.GroupingStore( {
    proxy : new Ext.data.HttpProxy({
      url: 'getDashletsInstances'
    }),
    reader : new Ext.data.JsonReader( {
      root: 'dashletsInstances',
      totalProperty: 'totalDashletsInstances',
      fields : [
        {name : 'DAS_INS_UID'},
        {name : 'AUTH_SOURCE_NAME'},
        {name : 'AUTH_SOURCE_PROVIDER'},
        {name : 'AUTH_SOURCE_SERVER_NAME'},
        {name : 'AUTH_SOURCE_PORT'},
        {name : 'AUTH_SOURCE_ENABLED_TLS'},
        {name : 'AUTH_SOURCE_VERSION'},
        {name : 'AUTH_SOURCE_BASE_DN'},
        {name : 'AUTH_ANONYMOUS'},
        {name : 'AUTH_SOURCE_SEARCH_USER'},
        {name : 'AUTH_SOURCE_ATTRIBUTES'},
        {name : 'AUTH_SOURCE_OBJECT_CLASSES'},
        {name : 'CURRENT_USERS', type:'int'}
      ]
    })
  });

  cmodel = new Ext.grid.ColumnModel({
      defaults: {
          width: 50,
          sortable: true
      },
      columns: [
          {id:'DAS_INS_UID', dataIndex: 'DAS_INS_UID', hidden:true, hideable:false},
          {header: _('ID_NAME'), dataIndex: 'AUTH_SOURCE_NAME', width: 200, hidden:false, align:'left'},
          {header: _('ID_PROVIDER'), dataIndex: 'AUTH_SOURCE_PROVIDER', width: 120, hidden: false, align: 'center'},
          {header: _('ID_SERVER_NAME'), dataIndex: 'AUTH_SOURCE_SERVER_NAME', width: 180, hidden: false, align: 'center'},
          {header: _('ID_PORT'), dataIndex: 'AUTH_SOURCE_PORT', width: 60, hidden: false, align: 'center'},
          {header: _('ID_ACTIVE_USERS'), dataIndex: 'CURRENT_USERS', width: 90, hidden: false, align: 'center'}
      ]
  });

  storePageSize = new Ext.data.SimpleStore({
      fields: ['size'],
       data: [['20'],['30'],['40'],['50'],['100']],
       autoLoad: true
  });

  comboPageSize = new Ext.form.ComboBox({
    typeAhead     : false,
    mode          : 'local',
    triggerAction : 'all',
    store: storePageSize,
    valueField: 'size',
    displayField: 'size',
    width: 50,
    editable: false,
    listeners:{
      select: function(c,d,i){
        UpdatePageConfig(d.data['size']);
        bbarpaging.pageSize = parseInt(d.data['size']);
        bbarpaging.moveFirst();
      }
    }
  });

  comboPageSize.setValue(pageSize);

  bbarpaging = new Ext.PagingToolbar({
    pageSize: pageSize,
    store: store,
    displayInfo: true,
    //displayMsg: _('ID_GRID_PAGE_DISPLAYING_DASHLET_MESSAGE') + '&nbsp; &nbsp; ',
    displayMsg: 'Displaying dashlets instances {0} - {1} of {2}' + '&nbsp; &nbsp; ',
    //emptyMsg: _('ID_GRID_PAGE_NO_DASHLET_MESSAGE'),
    emptyMsg: 'No dashlets instances to display',
    items: ['-',_('ID_PAGE_SIZE')+':',comboPageSize]
  });

  infoGrid = new Ext.grid.GridPanel({
    region: 'center',
    layout: 'fit',
    id: 'infoGrid',
    height:100,
    autoWidth : true,
    stateful : true,
    stateId : 'grid',
    enableColumnResize: true,
    enableHdMenu: true,
    frame:false,
    //iconCls:'icon-grid',
    columnLines: false,
    viewConfig: {
      forceFit:true
    },
    //title : _('ID_DASHLETS_INSTANCES'),
    title : 'Dashlets Instances',
    store: store,
    cm: cmodel,
    sm: smodel,
    tbar: actionButtons,
    bbar: bbarpaging,
    listeners: {
      rowdblclick: editDashletInstance,
      render: function(){
        this.loadMask = new Ext.LoadMask(this.body, {msg:_('ID_LOADING_GRID')});
      }
    },
    view: new Ext.grid.GroupingView({
      forceFit:true,
      groupTextTpl: '{text}',
      cls:"x-grid-empty",
      emptyText: _('ID_NO_RECORDS_FOUND')
    })
  });

  infoGrid.on('rowcontextmenu',
      function (grid, rowIndex, evt) {
          var sm = grid.getSelectionModel();
          sm.selectRow(rowIndex, sm.isSelected(rowIndex));
      },
      this
  );

  infoGrid.on('contextmenu',
      function (evt) {
          evt.preventDefault();
      },
      this
  );

  infoGrid.addListener('rowcontextmenu',onMessageContextMenu,this);

  infoGrid.store.load();

  viewport = new Ext.Viewport({
    layout: 'fit',
    autoScroll: false,
    items: [
       infoGrid
    ]
  });
});

//Funtion Handles Context Menu Opening
onMessageContextMenu = function (grid, rowIndex, e) {
    e.stopEvent();
    var coords = e.getXY();
    contextMenu.showAt([coords[0], coords[1]]);
};

//Load Grid By Default
gridByDefault = function(){
  //searchText.reset();
  infoGrid.store.load();
};

//Do Search Function
/*doSearch = function(){
   infoGrid.store.load({params: {textFilter: searchText.getValue()}});
};*/

//New Dashlet Instance Action
newDashletInstance = function() {
  location.href = 'dashletInstanceForm';
};

//Edit Dashlet Instance Action
editDashletInstance = function(){
  var rowSelected = infoGrid.getSelectionModel().getSelected();
  if (rowSelected){
    location.href = 'dashletInstanceForm?dasInsUid=' + rowSelected.data.DAS_INS_UID;
  }
};

//Delete Dashlet Instance Action
deleteDashletInstance = function(){
  var rowSelected = infoGrid.getSelectionModel().getSelected();
  /*if (rowSelected){
    viewport.getEl().mask(_('ID_PROCESSING'));
    Ext.Ajax.request({
      url: 'deleteDashletInstance',
      params: {dasInsUid: rowSelected.data.DAS_INS_UID},
      success: function(r,o){
          viewport.getEl().unmask();
          response = Ext.util.JSON.decode(r.responseText);
          if (response.success){
            Ext.Msg.confirm(_('ID_CONFIRM'),_('ID_CONFIRM_DELETE_DASHLET_INSTANCE'),function(btn,text){
            if (btn=='yes'){
              viewport.getEl().mask(_('ID_PROCESSING'));
                Ext.Ajax.request({
                  url: 'deleteDashletInstance',
                  params: {dasInsUid : rowSelected.data.DAS_INS_UID},
                  success: function(r,o){
                    viewport.getEl().unmask();
                    resp = Ext.util.JSON.decode(r.responseText);
                    if (resp.success){
                      PMExt.notify(_('ID_DASHLET_INSTANCE'),_('ID_DASHLET_SUCCESS_DELETE'));
                    }else{
                      PMExt.error(_('ID_DASHLET_INSTANCE'),resp.error);
                    }
                    //doSearch();
                    editButton.disable();
                    deleteButton.disable();
                  },
                  failure: function(r,o){
                    viewport.getEl().unmask();
                  }
                });
            }
            });

          }else{
           PMExt.error(_('ID_DASHLET_INSTANCE'),_('ID_MSG_CANNOT_DELETE_DASHLET'));
          }
      },
      failure: function(r,o){
        viewport.getEl().unmask();
      }
    });
  }*/
};