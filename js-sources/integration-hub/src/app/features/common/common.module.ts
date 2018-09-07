import {NgModule} from '@angular/core';
import {SuccessMessagesComponent} from "./success-messages/success-messages.component";
import {ErrorMessagesComponent} from "./error-messages/error-messages.component";
import {CommonModule} from "@angular/common";

@NgModule({
    imports: [
        CommonModule
    ],
    exports: [ErrorMessagesComponent, SuccessMessagesComponent],
    declarations: [ErrorMessagesComponent, SuccessMessagesComponent]
})
export class CommonFeaturesModule {
}
