import {NgModule} from '@angular/core';
import {ApplicationsModule} from "./applications/applications.module";
import {NavigationComponent} from "@app/features/navigation/navigation.component";
import {CommonModule} from "@angular/common";
import {LoginComponent} from "@app/features/login/login.component";
import {ReactiveFormsModule} from "@angular/forms";
import {CommonFeaturesModule} from "@app/features/common/common.module";

@NgModule({
    imports: [
        CommonModule,
        ReactiveFormsModule,
        ApplicationsModule,
        CommonFeaturesModule
    ],
    exports: [NavigationComponent],
    declarations: [NavigationComponent, LoginComponent]
})
export class FeaturesModule {
}
