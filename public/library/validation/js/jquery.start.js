$(document).ready(function() {
    $("#form_tffreg").validate({
        rules: {
            tff_title: { required: true },
            tff_name: { required: true },
            tff_last: { required: true },
            tff_display: { required: true },
            tff_email: {
                required: true,
                email: true
            },
            tff_bd: { required: true },
            tff_bm: { required: true },
            tff_by: { required: true },
            tff_tel: { required: true },
            tff_pass: { required: true },
            tff_pass_confirm: {
                required: true,
                equalTo: "#tff_pass"
            },
            tff_no: { required: true },
            tff_job: { required: true },

            tff_ans1: { required: true },
            tff_ans2: { required: true },
            tff_ans3_1: { require_from_group: [1, ".a3"] },
            tff_ans3_2: { require_from_group: [1, ".a3"] },
            tff_ans3_3: { require_from_group: [1, ".a3"] },
            tff_ans3_4: { require_from_group: [1, ".a3"] },
            tff_ans3_5: { require_from_group: [1, ".a3"] },
            tff_ans3_6: { require_from_group: [1, ".a3"] },
            tff_ans3_7: { require_from_group: [1, ".a3"] },
            tff_ans3_8: { require_from_group: [1, ".a3"] },

            tff_ans4_1: { require_from_group: [1, ".a4"] },
            tff_ans4_2: { require_from_group: [1, ".a4"] },
            tff_ans4_3: { require_from_group: [1, ".a4"] },
            tff_ans4_4: { require_from_group: [1, ".a4"] },
            tff_ans4_5: { require_from_group: [1, ".a4"] },
            tff_ans4_6: { require_from_group: [1, ".a4"] },
            tff_ans4_7: { require_from_group: [1, ".a4"] },
            tff_ans4_8: { require_from_group: [1, ".a4"] },
            tff_ans4_9: { require_from_group: [1, ".a4"] },
            tff_ans4_10: { require_from_group: [1, ".a4"] },

            tff_check: { required: true },
        },

        messages: {
            tff_title: "เลือกคำนำชื่อ",
            tff_name: "กรอกชื่อ",
            tff_last: "กรอกนามสกุล",
            tff_display: "กรอก Display Name",
            tff_email: {
                required: "กรอก Email",
                email: 'รูปแบบ Email ไม่ถูกต้อง'
            },
            tff_bd: "กรอกวันที่",
            tff_bm: "เลือกเดือน",
            tff_by: "กรอก พ.ศ.",
            tff_tel: "กรอกหมายเลขโทรศัพท์",
            tff_pass: "กรอก Password",
            tff_pass_confirm: {
                required: "กรอกยืนยัน Password",
                equalTo: 'Password ไม่ตรงกัน'
            },
            tff_no: "กรอกหมายเลข",
            tff_job: "กรอกอาขีพ",

            tff_ans1: "กรุณาเลือกคำตอบ",
            tff_ans2: "กรุณาเลือกคำตอบ",
            tff_ans3_1: "กรุณาเลือกผลิตภัณฑ์ / บริการ",
            tff_ans4_1: "กรุณาเลือกคุณรู้จักเอส เอ็น เอ็น จากช่องทางใด",
            tff_check: "กรุณาทำเครื่องหมายว่าอ่านแล้ว ข้อตกลงและเงื่อนไข"

        },
        errorPlacement: function(error, element) {
            var name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));
        },
    });

}); // JavaScript Document