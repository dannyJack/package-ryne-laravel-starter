'use strict';

if (TOASTR_MESSAGES.length > 0) {
    for (var item in TOASTR_MESSAGES) {
        toastr[item[0]](item[1]);
    }
}
