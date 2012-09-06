    (function() {
        tinymce.create('tinymce.plugins.wrong_right', {
            init : function(ed, url) {
                ed.addButton('wrong', {
                    title : 'Add a wrong',
                    image : url+'/IMG/wrong.jpg',
                    onclick : function() {
                         ed.selection.setContent('[wrong]' + ed.selection.getContent() + '[/wrong]');

                    }
                });
                ed.addButton('right', {
                    title : 'Add a right',
                    image : url+'/IMG/right.jpg',
                    onclick : function() {
                         ed.selection.setContent('[right]' + ed.selection.getContent() + '[/right]');

                    }
                });
            },
            createControl : function(n, cm) {
                return null;
            },
        });
        tinymce.PluginManager.add('wrong', tinymce.plugins.wrong_right);
        tinymce.PluginManager.add('right', tinymce.plugins.wrong_right);
    })();