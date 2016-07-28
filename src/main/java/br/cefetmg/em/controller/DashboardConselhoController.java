package br.cefetmg.em.controller;

import java.util.ArrayList;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import br.cefetmg.em.service.CourseGradeService;

@CrossOrigin(maxAge = 3600)
@RestController
@RequestMapping("/dashboard")
public class DashboardConselhoController {

	@Autowired
	private CourseGradeService cgService;

    @RequestMapping("/lostgrades")
    public ArrayList<Map<String,String>> getCourseGrades() {
    	return cgService.findNumberLostGradesPerClass(2, 1, 2, 2015);
    }
    
    @RequestMapping("/averagesgrades")
    public ArrayList<Map<String,String>> getCourseAveragesGrades() {
    	return cgService.findClassAveragesGrades(2, 1, 2015);
    }
}
