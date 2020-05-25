$(function() {
    let $sign_in_block = $("#sign_page #sign_in");
    let $sign_up_block = $("#sign_page #sign_up");
    let $before_block = $("#sign_page #before");
    let $left_block = $("#sign_page #left");
    let $right_block = $("#sign_page #right");
    let $buttons = $("#sign_page #left button, #sign_page #right button");

    $buttons.on("click", function(e) {
        let text = e.target.innerText;
        if (text == $buttons[1].innerText) {
            $sign_in_block.css({
                "left" : "50%",
                "z-index" : "1"
            });
            $sign_up_block.css({
                "left" : "50%",
                "z-index" : "2"
            });
            $before_block.css({
                "left" : "0",
                "background-position" : "0 0"
            })
            $left_block.css({
                "left" : "0"
            });
            $right_block.css({
                "left" : "110%"
            });

        } else {
            $sign_in_block.css({
                "left" : "0",
                "z-index" : "2"
            });
            $sign_up_block.css({
                "left" : "0",
                "z-index" : "1"
            });
            $before_block.css({
                "left" : "50%",
                "background-position" : "100% 0"
            })
            $left_block.css({
                "left" : "-110%"
            });
            $right_block.css({
                "left" : "0"
            });
        }
    })
})