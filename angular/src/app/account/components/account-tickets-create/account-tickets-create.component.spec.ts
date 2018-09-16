import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AccountTicketsCreateComponent } from './account-tickets-create.component';

describe('AccountTicketsCreateComponent', () => {
  let component: AccountTicketsCreateComponent;
  let fixture: ComponentFixture<AccountTicketsCreateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AccountTicketsCreateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AccountTicketsCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
