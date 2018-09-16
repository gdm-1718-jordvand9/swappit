import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AccountTicketsEditComponent } from './account-tickets-edit.component';

describe('AccountTicketsEditComponent', () => {
  let component: AccountTicketsEditComponent;
  let fixture: ComponentFixture<AccountTicketsEditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AccountTicketsEditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AccountTicketsEditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
