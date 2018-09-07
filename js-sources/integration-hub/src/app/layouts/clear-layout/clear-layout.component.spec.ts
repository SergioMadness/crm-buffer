import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ClearLayoutComponent } from './clear-layout.component';

describe('ClearLayoutComponent', () => {
  let component: ClearLayoutComponent;
  let fixture: ComponentFixture<ClearLayoutComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ClearLayoutComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ClearLayoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
