function myBlock() {
    $.blockUI({
        timeout:1000,
        baseZ: 2000,
        message: $("#block-ui"),
        css: {
            'border-radius': '10px',
            border: 'none',
        }
    });
}
