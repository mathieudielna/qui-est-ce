/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.paa.immo;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ResponseBody;
/**
 *
 * @author mathieudielna
 */

@Controller
public class MainController {
    
    @GetMapping("/")
    @ResponseBody
    public String index() {
	return "<p>Welcome Index!</p>";
    }
}
