import {NgModule} from '@angular/core';
import {ApplicationListComponent} from './application-list/application-list.component';
import {ApplicationEditComponent} from './application-edit/application-edit.component';
import {RouterModule} from "@angular/router";
import {ApiModule} from "@app/core/api.module";
import {CommonModule} from "@angular/common";
import {CommonFeaturesModule} from "@app/features/common/common.module";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";

@NgModule({
    imports: [
        CommonModule,
        RouterModule,
        ApiModule,
        CommonFeaturesModule,
        ReactiveFormsModule,
        FormsModule
    ],
    declarations: [ApplicationListComponent, ApplicationEditComponent]
})
export class ApplicationsModule {
}
