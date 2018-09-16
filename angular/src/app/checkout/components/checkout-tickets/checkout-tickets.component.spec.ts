import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CheckoutTicketsComponent } from './checkout-tickets.component';

describe('CheckoutTicketsComponent', () => {
  let component: CheckoutTicketsComponent;
  let fixture: ComponentFixture<CheckoutTicketsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CheckoutTicketsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CheckoutTicketsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
