/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

import java.io.Serializable;
import java.util.Collection;
import javax.persistence.Basic;
import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author mathieudielna
 */
@Entity
@Table(name="ville")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Ville_1.findAll", query = "SELECT v FROM Ville_1 v"),
    @NamedQuery(name = "Ville_1.findByIdVille", query = "SELECT v FROM Ville_1 v WHERE v.idVille = :idVille"),
    @NamedQuery(name = "Ville_1.findByCodePostal", query = "SELECT v FROM Ville_1 v WHERE v.codePostal = :codePostal"),
    @NamedQuery(name = "Ville_1.findByLibelle", query = "SELECT v FROM Ville_1 v WHERE v.libelle = :libelle")})
public class Ville implements Serializable {

    @OneToMany(cascade = CascadeType.ALL, mappedBy = "idVille")
    private Collection<Maison> maisonCollection;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "idVille")
    private Collection<Appartement> appartementCollection;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "idVille")
    private Collection<Logement> logementCollection;

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "idVille")
    private Integer idVille;
    @Basic(optional = false)
    @Column(name = "codePostal")
    private String codePostal;
    @Basic(optional = false)
    @Column(name = "libelle")
    private String libelle;

    public Ville() {
    }

    public Ville(Integer idVille) {
        this.idVille = idVille;
    }

    public Ville(Integer idVille, String codePostal, String libelle) {
        this.idVille = idVille;
        this.codePostal = codePostal;
        this.libelle = libelle;
    }

    public Integer getIdVille() {
        return idVille;
    }

    public void setIdVille(Integer idVille) {
        this.idVille = idVille;
    }

    public String getCodePostal() {
        return codePostal;
    }

    public void setCodePostal(String codePostal) {
        this.codePostal = codePostal;
    }

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idVille != null ? idVille.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Ville)) {
            return false;
        }
        Ville other = (Ville) object;
        if ((this.idVille == null && other.idVille != null) || (this.idVille != null && !this.idVille.equals(other.idVille))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entity.Ville_1[ idVille=" + idVille + " ]";
    }

    @XmlTransient
    public Collection<Maison> getMaisonCollection() {
        return maisonCollection;
    }

    public void setMaisonCollection(Collection<Maison> maisonCollection) {
        this.maisonCollection = maisonCollection;
    }

    @XmlTransient
    public Collection<Appartement> getAppartementCollection() {
        return appartementCollection;
    }

    public void setAppartementCollection(Collection<Appartement> appartementCollection) {
        this.appartementCollection = appartementCollection;
    }

    @XmlTransient
    public Collection<Logement> getLogementCollection() {
        return logementCollection;
    }

    public void setLogementCollection(Collection<Logement> logementCollection) {
        this.logementCollection = logementCollection;
    }
    
}
