import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VerifiedEmailPageComponent } from './verified-email-page.component';

describe('VerifiedEmailPageComponent', () => {
  let component: VerifiedEmailPageComponent;
  let fixture: ComponentFixture<VerifiedEmailPageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VerifiedEmailPageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VerifiedEmailPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
