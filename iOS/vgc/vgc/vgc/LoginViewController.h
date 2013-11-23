//
//  LoginViewController.h
//  vgc
//
//  Created by Sarav Ramaswamy on 11/16/13.
//  Copyright (c) 2013 Simply Hired. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface LoginViewController : UIViewController
@property (weak, nonatomic) IBOutlet UITextField *userName;
@property (weak, nonatomic) IBOutlet UITextField *password;
@property (weak, nonatomic) IBOutlet UIButton *loginButton;

@end
